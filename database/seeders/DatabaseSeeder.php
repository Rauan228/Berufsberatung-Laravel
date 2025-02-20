<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            InstitutionsTableSeeder::class,
            GlobalSpecialtiesTableSeeder::class,
            EventsCalendarTableSeeder::class,
            ApplicationsTableSeeder::class,
            NotificationsTableSeeder::class,
            GrantsTableSeeder::class,
            ReviewsTableSeeder::class,
            LikesTableSeeder::class,
            AdminsTableSeeder::class,
            SpecialtiesSeeder::class,
            InstitutionSpecialtiesSeeder::class,
        ]);
    }
}
