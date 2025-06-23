<?php

namespace App\Services;

use App\Models\CareerTestResult;
use OpenAI;

class CareerOrientationService
{
    /**
     * Generate summary & suggestions for passed CareerTestResult.
     */
    public function process(CareerTestResult $result): void
    {
        $prompt = $this->buildPrompt($result);

        $openai = OpenAI::client(config('services.openai.key'));

        try {
            $response = $openai->chat()->create([
                'model' => 'gpt-3.5-turbo-16k',
                'messages' => [
                    ['role' => 'system', 'content' => 'Ты опытный карьерный консультант. Все ответы на русском.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.8,
                'max_tokens' => 3000,
            ]);

            $content = $response->choices[0]->message->content ?? '';
            $parsed  = $this->parseAiOutput($content);

            $ids = $this->mapNamesToIds($parsed['specialties'] ?? [], $result->institution_type);

            $result->update([
                'summary'     => $parsed['summary'] ?? null,
                'suggestions' => empty($ids) ? ($parsed['specialties'] ?? []) : $ids,
            ]);
        } catch (\Throwable $e) {
            \Log::warning('OpenAI error: '.$e->getMessage());
            // Оставляем результат без AI-данных, но не прерываем обработку
        }
    }

    /* --------------------------------------------------------------------- */
    private function buildPrompt(CareerTestResult $result): string
    {
        // Собираем список доступных специальностей (названий) для выбранного типа учреждения
        $table = $result->institution_type === 'college' ? 'college_specializations' : 'specializations';
        $available = \DB::table($table)->pluck('name')->toArray();
        $availableList = implode(', ', $available);

        return "Ты — опытный профориентолог и карьерный консультант. Пиши на русском, обращаясь к пользователю на \"вы\".\n".
               "Всегда подробно объясняй ход рассуждений: почему вы делаете тот или иной вывод, на какие ответы пользователя опираетесь.\n".
               "Учтите, что пользователь планирует поступать в: {$result->institution_type}.\n".
               "Ниже приведён список всех специальностей, которые доступны в нашей базе. Выбирайте рекомендации ТОЛЬКО из этого списка и передавайте их в поле \"specialties\" без изменений, чтобы мы могли найти их по названию: {$availableList}.\n".
               "Ниже — его ответы в формате JSON (в вопросах присутствует текст вопроса и его ответ):\n".
               json_encode($result->answers, JSON_UNESCAPED_UNICODE)."\n\n".
               "Сформируй ЧИСТЫЙ JSON (без Markdown-форматирования, оглавлений и лишних комментариев) строго такого вида: {\n".
               "  \"summary\": \"<Не менее 2 000 символов, разбито минимум на 6–8 абзацев по 4–6 предложений каждый. Каждый абзац должен ссылаться на ответы пользователя. \n".
               "      1) Подробно опиши, какие интересы, склонности и ценности просматриваются в ответах (используй формулировку ‟поскольку вы выбрали ... в вопросе X\")\n".
               "      2) Раскрой сильные стороны, навыки и качества – также с явными ссылками на ответы.\n".
               "      3) Опиши оптимальную учебную и рабочую среду.\n".
               "      4) Сформулируй минимум 3–5 рекомендаций конкретных специальностей/направлений, и после каждого названия объясни, почему оно подходит, снова с привязкой к ответам.\n".
               "      5) Подробно распиши ход рассуждений: как именно из ответов ты пришёл к данным выводам.\n".
               "      6) Предложи следующие шаги: мероприятия, курсы, практики.>\",\n".
               "  \"specialties\": [ \"Название специальности 1\", \"Название 2\", ... ]\n".
               "}";
    }

    private function parseAiOutput(string $text): array
    {
        if (preg_match('/\{.*\}/s', $text, $m)) {
            return json_decode($m[0], true) ?: [];
        }
        return [];
    }

    private function mapNamesToIds(array $names, string $type): array
    {
        if (empty($names)) return [];

        $table = $type === 'college' ? 'college_specializations' : 'specializations';

        $ids = [];
        foreach ($names as $name) {
            // 1) точное совпадение
            $id = \DB::table($table)->where('name', $name)->value('id');

            // 2) если не нашли — пробуем частичное совпадение (LIKE)
            if (!$id) {
                $id = \DB::table($table)
                    ->where('name', 'like', '%'.trim($name).'%')
                    ->value('id');
            }

            if ($id) {
                $ids[] = $id;
            }
        }

        return array_values(array_unique($ids));
    }
} 