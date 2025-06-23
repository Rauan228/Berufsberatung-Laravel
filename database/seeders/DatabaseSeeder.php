<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Сначала создаем учреждения (institutions)
        $this->call(InstitutionsTableSeeder::class);
        // Добавляем направления для учреждений
        $this->call(InstitutionDirectionsSeeder::class);

        // 2. Создаем специальности университетов
        $this->call(UniversitySpecialtiesSeeder::class);
        
        // 3. Создаем специальности колледжей
        $this->call(CollegeSpecialtiesSeeder::class);

        // 4. Создаем связи специальностей с учреждениями
        $this->call(InstitutionSpecialtiesSeeder::class);
        $this->call(CollegeInstitutionSpecsSeeder::class);

        // 5. Добавляем дополнительную информацию о специальностях
        $this->call(SpecializationAboutSeeder::class);
        $this->call(CollegeSpecializationAboutSeeder::class);

        // 6. Создаем пользователей и администраторов
        $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);

        // 7. Создаем контент (события, заявки, уведомления и т.д.)
        $this->call([
            EventsCalendarTableSeeder::class,
            ApplicationsTableSeeder::class,
            NotificationsTableSeeder::class,
            GrantsTableSeeder::class,
            ReviewsTableSeeder::class,
            LikesTableSeeder::class,
        ]);

        // 8. Создаем дефолтного админа
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // 9. Создаем тестовых пользователей
        User::factory()->count(20)->create();

        $this->call(TestResultsTableSeeder::class);
    }
}
