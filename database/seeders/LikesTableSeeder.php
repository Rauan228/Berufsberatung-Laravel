<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LikesTableSeeder extends Seeder
{
    /**
     * Запуск сидера.
     */
    public function run()
    {
        // Очищаем таблицу лайков
        DB::table('likes')->delete();
        
        $likes = [];
        $totalUsers = 130;
        $universitiesRange = [1, 18]; // Университеты ID 1-18
        $collegesRange = [19, 42];    // Колледжи ID 19-42
        
        $this->command->info("Генерируем лайки для {$totalUsers} пользователей...");
        
        // Проходим по всем пользователям
        for ($userId = 1; $userId <= $totalUsers; $userId++) {
            
            // Добавляем 5 случайных университетов для текущего пользователя
            $selectedUniversities = $this->getRandomInstitutions($universitiesRange[0], $universitiesRange[1], 5);
            foreach ($selectedUniversities as $institutionId) {
                $randomDate = $this->getRandomDate();
                
                $likes[] = [
                    'user_id' => $userId,
                    'institution_id' => $institutionId,
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ];
            }
            
            // Добавляем 5 случайных колледжей для текущего пользователя
            $selectedColleges = $this->getRandomInstitutions($collegesRange[0], $collegesRange[1], 10);
            foreach ($selectedColleges as $institutionId) {
                $randomDate = $this->getRandomDate();
                
                $likes[] = [
                    'user_id' => $userId,
                    'institution_id' => $institutionId,
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ];
            }
            
            // Выводим прогресс каждые 20 пользователей
            if ($userId % 20 == 0) {
                $this->command->info("Обработано пользователей: {$userId}/{$totalUsers}");
            }
        }
        
        // Вставляем все лайки одним запросом для оптимизации
        if (!empty($likes)) {
            // Разбиваем на части по 1000 записей для избежания ограничений MySQL
            $chunks = array_chunk($likes, 1000);
            foreach ($chunks as $chunk) {
                DB::table('likes')->insert($chunk);
            }
            
            $totalLikes = count($likes);
            $this->command->info("Успешно создано {$totalLikes} лайков!");
            $this->command->info("Каждый пользователь добавил в избранные 5 университетов и 5 колледжей");
        }
    }
    
    /**
     * Получить случайные уникальные ID учреждений из диапазона
     */
    private function getRandomInstitutions($minId, $maxId, $count)
    {
        $availableIds = range($minId, $maxId);
        
        // Если запрашиваемое количество больше доступных ID, возвращаем все доступные
        if ($count >= count($availableIds)) {
            return $availableIds;
        }
        
        // Перемешиваем массив и берем нужное количество
        shuffle($availableIds);
        return array_slice($availableIds, 0, $count);
    }
    
    /**
     * Получить случайную дату в пределах последнего года
     */
    private function getRandomDate()
    {
        return Carbon::now()
            ->subDays(rand(0, 365))
            ->subHours(rand(0, 23))
            ->subMinutes(rand(0, 59))
            ->subSeconds(rand(0, 59));
    }
}
