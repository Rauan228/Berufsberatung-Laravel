<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Создаем пользователей (users)
        DB::table('users')->insert([
            [
                'username'   => 'johndoe',
                'email'      => 'johndoe@example.com',
                'password'   => bcrypt('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'janedoe',
                'email'      => 'janedoe@example.com',
                'password'   => bcrypt('password456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'hala',
                'email'      => 'hala@example.com',
                'password'   => bcrypt('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'madrif',
                'email'      => 'madrif@example.com',
                'password'   => bcrypt('password456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'hsgfcx',
                'email'      => 'akbjnsdc@example.com',
                'password'   => bcrypt('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'alkjs',
                'email'      => 'alknsd@example.com',
                'password'   => bcrypt('password456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'jsdhbc',
                'email'      => 'ksjdh@example.com',
                'password'   => bcrypt('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'kdljhc',
                'email'      => 'ddfd@example.com',
                'password'   => bcrypt('password456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'dlknjcfd',
                'email'      => 'sfdssd@example.com',
                'password'   => bcrypt('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'ldknd',
                'email'      => 'dsfdfdf@example.com',
                'password'   => bcrypt('password456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'dlmfnv',
                'email'      => 'sf@example.com',
                'password'   => bcrypt('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username'   => 'ldkmfv',
                'email'      => 'afd@example.com',
                'password'   => bcrypt('password456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // 2. Создаем учебные заведения (institutions)
        DB::table('institutions')->insert([
            [
                'name'        => 'University of Career Development',
                'description' => 'A prestigious institution offering career guidance and professional development.',
                'location'    => 'New York, USA',
                'website'     => 'https://www.ucd.edu',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'Tech University',
                'description' => 'A leading university specializing in technology and career advancement.',
                'location'    => 'San Francisco, USA',
                'website'     => 'https://www.techu.edu',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ]);

        // 3. Создаем глобальные специальности (global_specialties)
        DB::table('global_specialties')->insert([
            [
                'specialty_name' => 'Software Engineering',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'specialty_name' => 'Data Science',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'specialty_name' => 'Cyber Security',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);

        // 4. Создаем связи между учебными заведениями и специальностями (institution_specialties)
        DB::table('institution_specialties')->insert([
            [
                'institution_id' => 1,
                'specialty_id'   => 1,
                'specialty_name' => 'Software Engineering',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'institution_id' => 1,
                'specialty_id'   => 2,
                'specialty_name' => 'Data Science',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'institution_id' => 2,
                'specialty_id'   => 3,
                'specialty_name' => 'Cyber Security',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);

        // 5. Создаем мероприятия (events_calendars)
        DB::table('events_calendar')->insert([
            [
                'institution_id' => 1,
                'event_name'     => 'Tech Career Fair',
                'event_date'     => Carbon::parse('2025-01-08 10:00:00'),
                'description'    => 'A career fair for students interested in tech jobs.',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'institution_id' => 2,
                'event_name'     => 'Data Science Symposium',
                'event_date'     => Carbon::parse('2025-03-15 09:00:00'),
                'description'    => 'A symposium on the future of data science.',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);

        // 6. Создаем заявки на мероприятия (applications)
        DB::table('applications')->insert([
            [
                'user_id'    => 1,
                'event_id'   => 1,
                'status'     => 'Accepted',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'    => 2,
                'event_id'   => 2,
                'status'     => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'    => 3,
                'event_id'   => 2,
                'status'     => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'    => 4,
                'event_id'   => 2,
                'status'     => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'    => 5,
                'event_id'   => 2,
                'status'     => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'    => 6,
                'event_id'   => 2,
                'status'     => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'    => 7,
                'event_id'   => 2,
                'status'     => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'    => 8,
                'event_id'   => 2,
                'status'     => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'    => 9,
                'event_id'   => 2,
                'status'     => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // 7. Создаем уведомления (notifications)
        // Так как в миграции таблицы notifications определены только id и timestamps,
        // здесь вставляем только пустые записи с временными метками.
        DB::table('notifications')->insert([
            'created_at' => now(),
            'updated_at' => now(),
            'event_id' => 1,
            'message' => 'You have been accepted to the Tech Career Fair.',
            'user_id' => 1,  // Make sure this is included
        ]);
        

        // 8. Создаем гранты (grants)
        DB::table('grants')->insert([
            [
                'institution_id'       => 1,
                'specialty_id'         => 1, // предполагаем, что это запись из institution_specialties с id = 1
                'grant_name'           => 'Tech Career Grant',
                'amount'               => 1500.00,
                'application_deadline' => '2025-01-30',
                'created_at'           => Carbon::now(),
                'updated_at'           => Carbon::now(),
            ],
            [
                'institution_id'       => 2,
                'specialty_id'         => 3, // для второго института берем запись с id = 3 (Cyber Security)
                'grant_name'           => 'Cyber Security Grant',
                'amount'               => 2000.00,
                'application_deadline' => '2025-03-01',
                'created_at'           => Carbon::now(),
                'updated_at'           => Carbon::now(),
            ],
        ]);

        // 9. Создаем отзывы (reviews)
        DB::table('reviews')->insert([
            [
                'user_id'        => 1,
                'institution_id' => 1,
                'rating'         => 5,
                'comment'        => 'An excellent institution with great resources.',
                'created_at'     => Carbon::now()->subHours(5),
                'updated_at'     => Carbon::now()->subHours(3),
            ],
            [
                'user_id'        => 2,
                'institution_id' => 2,
                'rating'         => 4,
                'comment'        => 'Good institution, but could use more industry connections.',
                'created_at'     => Carbon::now()->subDays(1),
                'updated_at'     => Carbon::now()->subHours(10),
            ],
            [
                'user_id'        => 3,
                'institution_id' => 2,
                'rating'         => 3,
                'comment'        => 'Decent, but some aspects need improvement.',
                'created_at'     => Carbon::now()->subMinutes(30),
                'updated_at'     => Carbon::now()->subMinutes(10),
            ],
            [
                'user_id'        => 4,
                'institution_id' => 1,
                'rating'         => 5,
                'comment'        => 'Outstanding facilities and faculty!',
                'created_at'     => Carbon::now()->subHours(8),
                'updated_at'     => Carbon::now()->subHours(6),
            ],
            [
                'user_id'        => 5,
                'institution_id' => 2,
                'rating'         => 2,
                'comment'        => 'Not satisfied with the quality of education.',
                'created_at'     => Carbon::now()->subDays(2)->subHours(3),
                'updated_at'     => Carbon::now()->subDays(1)->subHours(5),
            ],
            [
                'user_id'        => 6,
                'institution_id' => 2,
                'rating'         => 4,
                'comment'        => 'Overall good, but room for improvement.',
                'created_at'     => Carbon::now()->subDays(3)->subMinutes(15),
                'updated_at'     => Carbon::now()->subDays(2),
            ],
            [
                'user_id'        => 7,
                'institution_id' => 1,
                'rating'         => 5,
                'comment'        => 'Highly recommended for students!',
                'created_at'     => Carbon::now()->subHours(12),
                'updated_at'     => Carbon::now()->subHours(9),
            ],
            [
                'user_id'        => 8,
                'institution_id' => 2,
                'rating'         => 3,
                'comment'        => 'Could be better in terms of teaching quality.',
                'created_at'     => Carbon::now()->subDays(4),
                'updated_at'     => Carbon::now()->subDays(3)->subHours(4),
            ],
            [
                'user_id'        => 9,
                'institution_id' => 2,
                'rating'         => 4,
                'comment'        => 'Decent infrastructure and resources.',
                'created_at'     => Carbon::now()->subDays(5)->addMinutes(45),
                'updated_at'     => Carbon::now()->subDays(4)->addHours(2),
            ],
            [
                'user_id'        => 10,
                'institution_id' => 1,
                'rating'         => 5,
                'comment'        => 'One of the best institutions in the region!',
                'created_at'     => Carbon::now()->subWeeks(1),
                'updated_at'     => Carbon::now()->subDays(6),
            ],
        ]);
        

        // 10. Создаем лайки (likes)
        DB::table('likes')->insert([
            [
                'user_id'        => 1,
                'institution_id' => 1,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'user_id'        => 2,
                'institution_id' => 2,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);

        // 11. Добавляем администратора (admins)
        DB::table('admins')->insert([
            [
                'name'       => 'rauan',
                'email'      => 'admin@example.com',
                'password'   => bcrypt('admin123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
