<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApplicationsTableSeeder extends Seeder
{
    public function run()
    {
        // Данные для user_applications
        $statuses = ['Accepted', 'Rejected', 'Pending'];
        $userApplications = [];

        for ($i = 0; $i < 500; $i++) {
            $userApplications[] = [
                'user_id' => rand(1, 40),
                'event_id' => rand(1, 60),
                'status' => $statuses[array_rand($statuses)],
                'created_at' => Carbon::now()->subDays(rand(1, 30))->subHours(rand(1, 23))->subMinutes(rand(1, 59)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30))->subHours(rand(1, 23))->subMinutes(rand(1, 59)),
            ];
        }

        DB::table('user_applications')->insert($userApplications);

        // Данные для institution_applications
        $institutions = [
            [
                'institution_id' => '1',
                'institution_name' => 'Назарбаев Университет',
                'email' => 'nu@nu.edu.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '2',
                'institution_name' => 'Евразийский Национальный Университет имени Л.Н. Гумилёва',
                'email' => 'profenu@mail.ru',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '3',
                'institution_name' => 'Казахский Агротехнический Университет имени Сакена Сейфуллина',
                'email' => 'office@kazatu.edu.kz',
                'password' => Hash::make('password123'),
                'verified' => (bool) rand(0, 1),
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '4',
                'institution_name' => 'Медицинский Университет Астана',
                'email' => 'abiturient@amu.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '5',
                'institution_name' => 'Казахстанский Университет Экономики, Финансов и Международной Торговли',
                'email' => 'mailbox@kuef.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '6',
                'institution_name' => 'Академия Государственного Управления при Президенте Республики Казахстан',
                'email' => 'admission@apa.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '7',
                'institution_name' => 'Университет КАЗГЮУ',
                'email' => 'info@mnu.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '8',
                'institution_name' => 'Международный Университет Астаны',
                'email' => 'info@aiu.edu.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '9',
                'institution_name' => 'Астана IT Университет',
                'email' => 'astanait@mail.ru',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '10',
                'institution_name' => 'Казахстанский Университет Технологии и Бизнеса',
                'email' => 'akutb@mail.ru',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '11',
                'institution_name' => 'Университет «Туран-Астана»',
                'email' => 'admissions@tau-edu.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '12',
                'institution_name' => 'Казахский национальный университет искусств',
                'email' => 'Kaznui.priem@gmail.com',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '13',
                'institution_name' => 'Казахская национальная академия хореографии',
                'email' => 'info@balletacademy.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '14',
                'institution_name' => 'Карагандинский университет Казпотребсоюза, филиал в г. Астана',
                'email' => 'keu@mail.ru',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '15',
                'institution_name' => 'Казахстанский филиал МГУ им. М.В.Ломоносова',
                'email' => 'otvet@msu.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '16',
                'institution_name' => 'Национальный университет обороны Республики Казахстан',
                'email' => '',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '17',
                'institution_name' => 'Esil University',
                'email' => 'nuo@mail.ru',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'institution_id' => '18',
                'institution_name' => 'Евразийский гуманитарный институт имени А. Кусаинова',
                'email' => 'eagi_pk@egi.edu.kz',
                'password' => Hash::make('password123'),
                'verified' => 'accepted',

                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
        ];

        DB::table('institution_applications')->insert($institutions);
    }
}