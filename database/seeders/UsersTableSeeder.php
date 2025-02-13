<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['username' => 'Rauan Akhmetov', 'email' => 'rauan.akhmetov@example.com'],
            ['username' => 'Alisher Eschanov', 'email' => 'alisher.eschanov@example.com'],
            ['username' => 'Madina Sultanova', 'email' => 'madina.sultanova@example.com'],
            ['username' => 'Yerlan Mukashev', 'email' => 'yerlan.mukashev@example.com'],
            ['username' => 'Aigul Bekmukhanova', 'email' => 'aigul.bekmukhanova@example.com'],
            ['username' => 'Bolat Zhakupov', 'email' => 'bolat.zhakupov@example.com'],
            ['username' => 'Saule Abisheva', 'email' => 'saule.abisheva@example.com'],
            ['username' => 'Kanat Dosmukhamedov', 'email' => 'kanat.dosmukhamedov@example.com'],
            ['username' => 'Diana Karimova', 'email' => 'diana.karimova@example.com'],
            ['username' => 'Nurzhan Kairatov', 'email' => 'nurzhan.kairatov@example.com'],
            ['username' => 'Gaukhar Serikbayeva', 'email' => 'gaukhar.serikbayeva@example.com'],
            ['username' => 'Ruslan Saparov', 'email' => 'ruslan.saparov@example.com'],
            ['username' => 'Askhat Tuleuov', 'email' => 'askhat.tuleuov@example.com'],
            ['username' => 'Aruzhan Nurtayeva', 'email' => 'aruzhan.nurtayeva@example.com'],
            ['username' => 'Zhanar Kassenova', 'email' => 'zhanar.kassenova@example.com'],
            ['username' => 'Daulet Amankulov', 'email' => 'daulet.amankulov@example.com'],
            ['username' => 'Karim Alzhanov', 'email' => 'karim.alzhanov@example.com'],
            ['username' => 'Serik Zhumabekov', 'email' => 'serik.zhumabekov@example.com'],
            ['username' => 'Marat Abilov', 'email' => 'marat.abilov@example.com'],
            ['username' => 'Aliya Zhanibekova', 'email' => 'aliya.zhanibekova@example.com'],
            ['username' => 'Samal Zhaksylykova', 'email' => 'samal.zhaksylykova@example.com'],
            ['username' => 'Baurzhan Myrzakhmetov', 'email' => 'baurzhan.myrzakhmetov@example.com'],
            ['username' => 'Gulnar Yermekova', 'email' => 'gulnar.yermekova@example.com'],
            ['username' => 'Nurlan Baymukhanov', 'email' => 'nurlan.baymukhanov@example.com'],
            ['username' => 'Asylbek Tulegenov', 'email' => 'asylbek.tulegenov@example.com'],
            ['username' => 'Aizhan Kadyrova', 'email' => 'aizhan.kadyrova@example.com'],
            ['username' => 'Serikbek Amanzholov', 'email' => 'serikbek.amanzholov@example.com'],
            ['username' => 'Anel Iskakova', 'email' => 'anel.iskakova@example.com'],
            ['username' => 'Daniyar Bekmuratov', 'email' => 'daniyar.bekmuratov@example.com'],
            ['username' => 'Zhanel Sarsembayeva', 'email' => 'zhanel.sarsembayeva@example.com'],
            ['username' => 'Bakytzhan Kassymov', 'email' => 'bakytzhan.kassymov@example.com'],
            ['username' => 'Moldir Abilkhasym', 'email' => 'moldir.abilkhasym@example.com'],
            ['username' => 'Yerkin Sadykov', 'email' => 'yerkin.sadykov@example.com'],
            ['username' => 'Alua Shokanova', 'email' => 'alua.shokanova@example.com'],
            ['username' => 'Miras Zhantasov', 'email' => 'miras.zhantasov@example.com'],
            ['username' => 'Altynai Zhumabayeva', 'email' => 'altynai.zhumabayeva@example.com'],
            ['username' => 'Kuanysh Imanov', 'email' => 'kuanysh.imanov@example.com'],
            ['username' => 'Dana Omarova', 'email' => 'dana.omarova@example.com'],
            ['username' => 'Erzhan Makhambetov', 'email' => 'erzhan.makhambetov@example.com'],
            ['username' => 'Kamila Nurgaliyeva', 'email' => 'kamila.nurgaliyeva@example.com'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'username'   => $user['username'],
                'email'      => $user['email'],
                'password'   => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
