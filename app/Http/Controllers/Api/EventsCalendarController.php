<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventsCalendar;
use App\Models\Institution;

class EventsCalendarController extends Controller
{
    // Получить список событий
    public function index(Request $request)
    {
        $query = EventsCalendar::with('institution');

        // Фильтр по поисковому запросу
        if ($request->has('search') && $request->search) {
            $query->where('event_name', 'like', '%' . $request->search . '%');
        }

        // Фильтр по типу учреждения
        if ($request->has('institution_type') && $request->institution_type) {
            if ($request->institution_type === 'university') {
                $query->whereHas('institution', function($q) {
                    $q->whereBetween('id', [1, 18]);
                });
            } elseif ($request->institution_type === 'college') {
                $query->whereHas('institution', function($q) {
                    $q->whereBetween('id', [19, 42]);
                });
            }
        }

        // Фильтр по конкретному учреждению
        if ($request->has('institution_id') && $request->institution_id) {
            $query->where('institution_id', $request->institution_id);
        }

        // Сортировка по дате
        if ($request->has('date_sort') && $request->date_sort) {
            if ($request->date_sort === 'newest') {
                $query->orderBy('event_date', 'desc');
            } elseif ($request->date_sort === 'oldest') {
                $query->orderBy('event_date', 'asc');
            }
        } else {
            $query->orderBy('event_date', 'desc'); // По умолчанию сначала новые
        }

        $events = $query->paginate(24);
        return response()->json($events);
    }

    // Создать новое событие
    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
            'event_type' => 'required|in:open,closed,group',
        ]);

        $event = EventsCalendar::create($request->all());
        return response()->json($event, 201);
    }

    // Получить события по ID университета
    public function getEventsByInstitution($institutionId)
    {
        $events = EventsCalendar::where('institution_id', $institutionId)->get();
        return response()->json($events);
    }

    // Получить детали события
    public function show($id)
    {
        $event = EventsCalendar::with('institution')->findOrFail($id);
        return response()->json($event);
    }

    // Обновить событие
    public function update(Request $request, $id)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
            'event_type' => 'required|in:open,closed,group',
        ]);

        $event = EventsCalendar::findOrFail($id);
        $event->update($request->all());
        return response()->json($event);
    }

    // Удалить событие
    public function destroy($id)
    {
        EventsCalendar::destroy($id);
        return response()->json(null, 204);
    }

    // Пользователь подаёт/фиксирует заявку или команду на событие
    public function apply(Request $request, $id)
    {
        $event = EventsCalendar::findOrFail($id);

        if ($event->event_type === 'open') {
            // ничего не нужно – просто сообщаем успех
            return response()->json(['message' => 'Событие открыто, регистрация не требуется']);
        }

        if ($event->event_type === 'closed') {
            $rules = [ 'user_id' => 'required|exists:users,id' ];
            // Приводим схему к массиву, даже если в базе хранится JSON-строка
            $schema = $event->application_schema;

            if ($schema) {
                // Если пришла строка (обычно JSON), пробуем декодировать
                if (is_string($schema)) {
                    $decoded = json_decode($schema, true);
                    $schema = is_array($decoded) ? $decoded : [];
                }

                // На случай, если после всех преобразований значение всё ещё не массив
                if (!is_array($schema)) {
                    $schema = (array) $schema;
                }

                foreach ($schema as $field) {
                    $rule = ($field['required'] ?? false) ? 'required' : 'nullable';

                    $fieldType = $field['type'] ?? 'string';
                    switch ($fieldType) {
                        case 'number':
                            $rule .= '|numeric';
                            break;
                        case 'email':
                            $rule .= '|email';
                            break;
                        case 'phone':
                            // простая проверка телефона
                            $rule .= '|regex:/^[0-9+\-\s()]{4,}$/';
                            break;
                        default:
                            $rule .= '|string';
                    }

                    $fieldName = is_array($field) && isset($field['name']) ? $field['name'] : null;
                    if ($fieldName) {
                        $rules["payload.{$fieldName}"] = $rule;
                    }
                }

                // Общее правило для payload, чтобы Laravel ожидал массив полей
                if (!isset($rules['payload'])) {
                    $rules['payload'] = 'nullable|array';
                }
            }

            // Используем кастомный валидатор, чтобы вернуть первую ошибку в привычном формате
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'error'  => $validator->errors()->first(),
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = $validator->validated();

            $app = \App\Models\UserApplication::firstOrCreate(
                ['event_id'=>$event->id,'user_id'=>$data['user_id']],
                ['status'=>'pending','payload'=>$data['payload']??null]
            );

            return response()->json(['message' => 'Заявка принята', 'application' => $app]);
        }

        if ($event->event_type === 'group') {
            $groupRules = [
                'institution_id' => 'required|exists:institutions,id',
                'team_name'      => 'required|string|max:255',
                'members'        => 'required|array|min:1',
                'members.*.user_id' => 'required|exists:users,id',
                'members.*.role'    => 'nullable|string|max:100',
                'payload'        => 'nullable|array',
            ];

            $validator = \Validator::make($request->all(), $groupRules);

            if ($validator->fails()) {
                return response()->json([
                    'error'  => $validator->errors()->first(),
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = $validator->validated();

            // Создаём групповую заявку
            $groupApp = \App\Models\GroupApplication::create([
                'event_id' => $event->id,
                'institution_id' => $data['institution_id'],
                'team_name' => $data['team_name'],
                'status' => 'pending',
                'payload' => $data['payload'] ?? null,
            ]);

            foreach ($data['members'] as $member) {
                \App\Models\GroupApplicationMember::create([
                    'group_application_id' => $groupApp->id,
                    'user_id' => $member['user_id'],
                    'role' => $member['role'] ?? null,
                ]);
            }

            return response()->json(['message' => 'Командная заявка создана', 'group_application' => $groupApp]);
        }

        return response()->json(['error' => 'Unknown event type'], 400);
    }
}