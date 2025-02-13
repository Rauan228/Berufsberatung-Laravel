<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $reviews = [
            ['user_id' => 1, 'institution_id' => 1, 'rating' => 5, 'comment' => 'Отличное учебное заведение! Прекрасные преподаватели и современные методики.'],
            ['user_id' => 2, 'institution_id' => 1, 'rating' => 4, 'comment' => 'Хорошая атмосфера, но хотелось бы больше практических занятий.'],
            ['user_id' => 3, 'institution_id' => 2, 'rating' => 3, 'comment' => 'Средний уровень обучения. Некоторым преподавателям не хватает вовлеченности.'],
            ['user_id' => 4, 'institution_id' => 2, 'rating' => 5, 'comment' => 'Очень доволен курсами! Информация подается понятно и доступно.'],
            ['user_id' => 5, 'institution_id' => 3, 'rating' => 4, 'comment' => 'Хорошая база знаний, но иногда не хватает актуальных примеров.'],
            ['user_id' => 6, 'institution_id' => 3, 'rating' => 2, 'comment' => 'Организация учебного процесса оставляет желать лучшего.'],
            ['user_id' => 7, 'institution_id' => 4, 'rating' => 5, 'comment' => 'Великолепные возможности для профессионального роста!'],
            ['user_id' => 8, 'institution_id' => 4, 'rating' => 4, 'comment' => 'Хорошие преподаватели, но учебная программа немного устарела.'],
            ['user_id' => 9, 'institution_id' => 5, 'rating' => 3, 'comment' => 'Среднее качество обучения, но хорошие условия для студентов.'],
            ['user_id' => 10, 'institution_id' => 5, 'rating' => 5, 'comment' => 'Прекрасные курсы! Очень рад, что выбрал именно этот вуз.'],
            ['user_id' => 11, 'institution_id' => 6, 'rating' => 4, 'comment' => 'Учебное заведение достойное, но хотелось бы больше современных технологий в обучении.'],
            ['user_id' => 12, 'institution_id' => 6, 'rating' => 3, 'comment' => 'Некоторые предметы подаются слишком теоретически.'],
            ['user_id' => 13, 'institution_id' => 7, 'rating' => 5, 'comment' => 'Лучший выбор для тех, кто хочет качественное образование.'],
            ['user_id' => 14, 'institution_id' => 7, 'rating' => 2, 'comment' => 'Не оправдало ожиданий.'],
            ['user_id' => 15, 'institution_id' => 8, 'rating' => 4, 'comment' => 'Много полезной информации, но некоторые предметы слишком сложные.'],
            ['user_id' => 16, 'institution_id' => 8, 'rating' => 5, 'comment' => 'Отличные преподаватели и индивидуальный подход к студентам!'],
            ['user_id' => 17, 'institution_id' => 9, 'rating' => 4, 'comment' => 'Качественное образование, но хотелось бы больше интерактива.'],
            ['user_id' => 18, 'institution_id' => 9, 'rating' => 3, 'comment' => 'Средний уровень, но есть хорошие преподаватели.'],
            ['user_id' => 19, 'institution_id' => 10, 'rating' => 5, 'comment' => 'Очень сильная учебная программа, рекомендую!'],
            ['user_id' => 20, 'institution_id' => 10, 'rating' => 4, 'comment' => 'В целом доволен, но не хватает гибкости в расписании.'],
            ['user_id' => 1, 'institution_id' => 3, 'rating' => 5, 'comment' => 'Отличный преподавательский состав, материалы подаются доступно.'],
            ['user_id' => 2, 'institution_id' => 6, 'rating' => 4, 'comment' => 'Интересные лекции, но иногда не хватает обратной связи.'],
            ['user_id' => 3, 'institution_id' => 8, 'rating' => 3, 'comment' => 'Курсы хорошие, но хотелось бы больше примеров из реальной практики.'],
            ['user_id' => 4, 'institution_id' => 5, 'rating' => 4, 'comment' => 'Программы актуальны, преподаватели профессионалы своего дела.'],
            ['user_id' => 5, 'institution_id' => 2, 'rating' => 5, 'comment' => 'Советую всем, кто хочет развиваться в этой сфере.'],
            ['user_id' => 6, 'institution_id' => 9, 'rating' => 2, 'comment' => 'Ожидал большего, но в целом неплохо.'],
            ['user_id' => 7, 'institution_id' => 4, 'rating' => 5, 'comment' => 'Очень удобная платформа для обучения, много полезных материалов.'],
            ['user_id' => 8, 'institution_id' => 7, 'rating' => 4, 'comment' => 'Некоторые темы сложные, но преподаватели всегда помогают разобраться.'],
            ['user_id' => 9, 'institution_id' => 1, 'rating' => 3, 'comment' => 'Неплохая организация, но есть над чем работать.'],
            ['user_id' => 10, 'institution_id' => 10, 'rating' => 5, 'comment' => 'Прекрасный опыт, обязательно порекомендую друзьям.'],
            ['user_id' => 11, 'institution_id' => 3, 'rating' => 4, 'comment' => 'Очень сильные преподаватели, объясняют понятно и доступно.'],
            ['user_id' => 12, 'institution_id' => 5, 'rating' => 3, 'comment' => 'Можно было бы улучшить программу и добавить больше практики.'],
            ['user_id' => 13, 'institution_id' => 2, 'rating' => 5, 'comment' => 'Очень интересные занятия, много интерактива.'],
            ['user_id' => 14, 'institution_id' => 8, 'rating' => 4, 'comment' => 'Современные методики, качественные материалы.'],
            ['user_id' => 15, 'institution_id' => 9, 'rating' => 2, 'comment' => 'Много устаревшей информации, хотелось бы обновлений.'],
            ['user_id' => 16, 'institution_id' => 4, 'rating' => 5, 'comment' => 'Крутые преподаватели, обучение проходит на высоком уровне.'],
            ['user_id' => 17, 'institution_id' => 6, 'rating' => 3, 'comment' => 'Нормально, но есть заведения с более сильной программой.'],
            ['user_id' => 18, 'institution_id' => 7, 'rating' => 5, 'comment' => 'Отличное место для получения знаний и профессионального роста.'],
            ['user_id' => 19, 'institution_id' => 1, 'rating' => 4, 'comment' => 'Хорошая учебная база, но не всегда хватает практики.'],
            ['user_id' => 20, 'institution_id' => 10, 'rating' => 5, 'comment' => 'Восторг! Лучшие курсы, на которых я учился!'],
            ['user_id' => 1, 'institution_id' => 10, 'rating' => 5, 'comment' => 'Отличный университет с сильными преподавателями.'],
            ['user_id' => 2, 'institution_id' => 11, 'rating' => 4, 'comment' => 'Качественное образование, но хотелось бы больше практики.'],
            ['user_id' => 3, 'institution_id' => 12, 'rating' => 3, 'comment' => 'Организация учебного процесса могла бы быть лучше.'],
            ['user_id' => 4, 'institution_id' => 13, 'rating' => 5, 'comment' => 'Отличный университет! Интересные курсы и профессиональные преподаватели.'],
            ['user_id' => 5, 'institution_id' => 14, 'rating' => 2, 'comment' => 'Не оправдал ожиданий.'],
            ['user_id' => 6, 'institution_id' => 15, 'rating' => 4, 'comment' => 'Неплохой уровень обучения, но есть куда расти.'],
            ['user_id' => 7, 'institution_id' => 12, 'rating' => 5, 'comment' => 'Современные технологии и отличные условия для студентов.'],
            ['user_id' => 8, 'institution_id' => 11, 'rating' => 4, 'comment' => 'Очень интересные программы, но не хватает гибкости в расписании.'],
            ['user_id' => 9, 'institution_id' => 12, 'rating' => 3, 'comment' => 'Средний университет, но с хорошими преподавателями.'],
            ['user_id' => 10, 'institution_id' => 15, 'rating' => 5, 'comment' => 'Отличное место для учебы! Программы актуальны и полезны.'],
            ['user_id' => 11, 'institution_id' => 10, 'rating' => 4, 'comment' => 'Учиться здесь интересно, но иногда нагрузка слишком высокая.'],
            ['user_id' => 12, 'institution_id' => 10, 'rating' => 3, 'comment' => 'Преподаватели хорошие, но программа устарела.'],
            ['user_id' => 13, 'institution_id' => 11, 'rating' => 5, 'comment' => 'Отличный университет с международными возможностями.'],
            ['user_id' => 14, 'institution_id' => 12, 'rating' => 4, 'comment' => 'Достойное образование, но хотелось бы больше лабораторных занятий.'],
            ['user_id' => 15, 'institution_id' => 13, 'rating' => 3, 'comment' => 'Средний уровень. Есть лучшие университеты.'],
            ['user_id' => 16, 'institution_id' => 14, 'rating' => 5, 'comment' => 'Интересные лекции и хороший подход к студентам.'],
            ['user_id' => 17, 'institution_id' => 15, 'rating' => 2, 'comment' => 'Не понравилось. Организация слабая.'],
            ['user_id' => 18, 'institution_id' => 16, 'rating' => 5, 'comment' => 'Высокий уровень образования и сильные преподаватели.'],
            ['user_id' => 19, 'institution_id' => 14, 'rating' => 4, 'comment' => 'Современные методики, но нагрузка высокая.'],
            ['user_id' => 20, 'institution_id' => 13, 'rating' => 3, 'comment' => 'Нормальный университет, но хотелось бы больше практики.'],
            ['user_id' => 1, 'institution_id' => 14, 'rating' => 5, 'comment' => 'Лучший университет для технических специальностей.'],
            ['user_id' => 2, 'institution_id' => 10, 'rating' => 4, 'comment' => 'Прекрасное учебное заведение, но бюрократии многовато.'],
            ['user_id' => 3, 'institution_id' => 10, 'rating' => 5, 'comment' => 'Отличное место для учебы! Советую всем.'],
            ['user_id' => 4, 'institution_id' => 11, 'rating' => 4, 'comment' => 'Преподаватели замечательные, но хотелось бы больше практики.'],
            ['user_id' => 5, 'institution_id' => 12, 'rating' => 3, 'comment' => 'Организация учебного процесса не на высшем уровне.'],
            ['user_id' => 6, 'institution_id' => 13, 'rating' => 5, 'comment' => 'Прекрасное заведение с сильными программами.'],
            ['user_id' => 7, 'institution_id' => 14, 'rating' => 4, 'comment' => 'Учиться интересно, но иногда не хватает обратной связи от преподавателей.'],
            ['user_id' => 8, 'institution_id' => 15, 'rating' => 2, 'comment' => 'Не понравилось, ожидал большего.'],
            ['user_id' => 9, 'institution_id' => 16, 'rating' => 5, 'comment' => 'Отличные лаборатории и мощная база для студентов.'],
            ['user_id' => 10, 'institution_id' => 12, 'rating' => 4, 'comment' => 'Много возможностей для развития, но нагрузки много.'],
            ['user_id' => 11, 'institution_id' => 12, 'rating' => 3, 'comment' => 'Университет средний, есть куда расти.'],
            ['user_id' => 12, 'institution_id' => 12, 'rating' => 5, 'comment' => 'Очень доволен! Прекрасные курсы.'],
            ['user_id' => 13, 'institution_id' => 10, 'rating' => 4, 'comment' => 'Обучение хорошее, но с организацией бывают проблемы.'],
            ['user_id' => 14, 'institution_id' => 10, 'rating' => 5, 'comment' => 'Лучший выбор для студентов технических специальностей.'],
            ['user_id' => 15, 'institution_id' => 11, 'rating' => 4, 'comment' => 'Достойное образование, но хотелось бы больше проектной работы.'],
            ['user_id' => 16, 'institution_id' => 12, 'rating' => 3, 'comment' => 'Средний уровень, но хорошие преподаватели.'],
            ['user_id' => 17, 'institution_id' => 13, 'rating' => 5, 'comment' => 'Современные программы и удобный учебный процесс.'],
            ['user_id' => 18, 'institution_id' => 14, 'rating' => 2, 'comment' => 'Не самый лучший университет.'],
            ['user_id' => 19, 'institution_id' => 15, 'rating' => 5, 'comment' => 'Прекрасное заведение с возможностью стажировок за границей.'],
            ['user_id' => 20, 'institution_id' => 16, 'rating' => 4, 'comment' => 'Отличные курсы, но хотелось бы больше интерактива.'],
        ];

        foreach ($reviews as $review) {
            $createdAt = Carbon::now()->subDays(rand(1, 60))->subHours(rand(1, 23))->subMinutes(rand(1, 59));
            DB::table('reviews')->insert([
                'user_id'        => $review['user_id'],
                'institution_id' => $review['institution_id'],
                'rating'         => $review['rating'],
                'comment'        => $review['comment'],
                'created_at'     => $createdAt,
                'updated_at'     => $createdAt->copy()->addHours(rand(1, 12)),
            ]);
        }
    }
}
