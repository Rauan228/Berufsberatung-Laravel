<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InstitutionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('institutions')->insert([
            [
                'name'        => 'Назарбаев Университет',
                'description' => 'Один из ведущих университетов Казахстана с международными программами обучения.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://nu.edu.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Евразийский Национальный Университет имени Л.Н. Гумилёва',
                'description' => 'Крупный национальный университет, специализирующийся на науке и технологии.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://enu.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Казахский Агротехнический Университет имени Сакена Сейфуллина',
                'description' => 'Специализированный вуз по аграрным и техническим наукам.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://kazatu.edu.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Медицинский Университет Астана',
                'description' => 'Один из ведущих медицинских вузов Казахстана.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://amu.edu.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Казахстанский Университет Экономики, Финансов и Международной Торговли',
                'description' => 'Университет с экономическими и финансовыми специальностями.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://kuef.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Академия Государственного Управления при Президенте Республики Казахстан',
                'description' => 'Главный вуз по подготовке госслужащих Казахстана.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://pa-academy.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Университет КАЗГЮУ',
                'description' => 'Известный юридический университет Казахстана.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://kazguu.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Международный Университет Астаны',
                'description' => 'Международный университет с программами на английском языке.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://mui.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Астана IT Университет',
                'description' => 'Современный университет, ориентированный на IT и цифровые технологии.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://astanait.edu.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Казахстанский Университет Технологии и Бизнеса',
                'description' => 'Частный вуз, специализирующийся на бизнесе и технологиях.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://kutb.kz',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Университет «Туран-Астана»',
                'description' => 'ВУЗ успешно осуществляющий подготовку кадров по образовательным программам гуманитарно-экономического профиля, дизайна, сервиса и туризма.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://www.apa.kz/ru/',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Казахский национальный университет искусств',
                'description' => 'Является одним из ведущих учебных заведений в Казахстане по подготовке высококвалифицированных специалистов по направлениям музыки, театра, кинематографии, изобразительного искусства, дизайна, теории искусства, арт-менеджмента.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://www.apa.kz/ru/',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Казахская национальная академия хореографии',
                'description' => 'Первое высшее учебное заведение в Центральной Азии с полным циклом многоуровневого профессионального хореографического образования.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://www.apa.kz/ru/',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Карагандинский университет Казпотребсоюза, филиал в г. Астана',
                'description' => 'Представительство КЭУК в г. Нур-Султане имеет высококвалифицированный профессорско-преподавательский состав, обеспечивающий качественную подготовку специалистов экономического и юридического профиля.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://www.apa.kz/ru/',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Казахстанский филиал МГУ им. М.В.Ломоносова',
                'description' => 'Подразделение МГУ, одного из лучших мировых университетов, который в 2025 году отметил свой 270-летний юбилей.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://www.apa.kz/ru/',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Национальный университет обороны Республики Казахстан',
                'description' => 'Подготовка военных кадров стратегического, оперативно-стратегического и оперативно-тактического звена управления по программам магистратуры.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://www.apa.kz/ru/',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Esil University',
                'description' => 'Казахский университет экономики, финансов и международной торговли (КазУЭФМТ).',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://www.apa.kz/ru/',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name'        => 'Евразийский гуманитарный институт имени А. Кусаинова',
                'description' => 'Первый негосударственный вуз в столице Казахстана. Обучение в ЕАГИ дает возможность получить престижное и востребованное образование по очной и очной сокращенной форме обучения по образовательным программам бакалавриата.',
                'location'    => 'Астана, Казахстан',
                'website'     => 'https://www.apa.kz/ru/',
                'created_at'  => Carbon::now()->subDays(rand(1, 60)),
                'updated_at'  => Carbon::now()->subDays(rand(1, 60)),
            ],
        ]);

       
    }
}
