<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsCalendarTableSeeder extends Seeder
{
    public function run()
    {
        // Пул шаблонов (название, описание)
        $templates = [
            ['День открытых дверей', 'Возможность узнать больше о программах университета.'],
            ['Хакатон «Tech Future»', 'Соревнование по программированию с ценными призами.'],
            ['Выставка научных достижений', 'Демонстрация инновационных разработок студентов.'],
            ['Математическая олимпиада', 'Соревнование для любителей математики.'],
            ['Startup Weekend', 'Тренинг и хакатон для будущих стартаперов.'],
            ['Фестиваль искусств', 'Концерты, выставки и перформансы студентов.'],
            ['Карьерная ярмарка', 'Встреча студентов с работодателями.'],
            ['Семинар по soft-skills', 'Практикум по развитию навыков коммуникации.'],
        ];

        // Предопределённые схемы полей для заявок
        $closedSchema = [
            ['name' => 'full_name', 'label' => 'ФИО', 'type' => 'string', 'required' => true],
            ['name' => 'contacts',  'label' => 'Контактный телефон', 'type' => 'string', 'required' => true],
        ];

        $groupSchema = [
            ['name' => 'full_name', 'label' => 'ФИО', 'type' => 'string', 'required' => true],
            ['name' => 'role',      'label' => 'Роль в команде',       'type' => 'string', 'required' => false],
        ];

        // Получаем все учреждения разом (id, type)
        $institutions = DB::table('institutions')->select('id', 'type')->get();

        $insert = [];

        foreach ($institutions as $inst) {
            // Для каждого вуза гарантируем минимум 4 события (может чуть больше для разнообразия)
            $eventsCount = rand(4, 7);

            for ($i = 0; $i < $eventsCount; $i++) {
                // Берём случайный шаблон
                [$titleBase, $desc] = $templates[array_rand($templates)];
                // Чтобы названия не дублировались – добавим порядковый номер
                $title = $titleBase . ' #' . ($i + 1);

                // Случайно определяем тип события
                $type = ['open', 'closed', 'group'][array_rand([0, 1, 2])];

                // Схема заявки
                $schema = null;
                if ($type === 'closed') $schema = $closedSchema;
                if ($type === 'group')  $schema = $groupSchema;

                $insert[] = [
                    'institution_id'     => $inst->id,
                    'institution_type'   => $inst->type,
                    'event_name'         => $title,
                    'event_date'         => Carbon::now()->addDays(rand(-180, 180))->setTime(rand(9, 18), rand(0, 59)),
                    'description'        => $desc,
                    'event_type'         => $type,
                    'application_schema' => $schema ? json_encode($schema, JSON_UNESCAPED_UNICODE) : null,
                    'created_at'         => Carbon::now()->subDays(rand(1, 60)),
                    'updated_at'         => Carbon::now()->subDays(rand(1, 60)),
                ];
            }
        }

        // Массовая вставка для производительности
        DB::table('events_calendar')->insert($insert);
    }
}
