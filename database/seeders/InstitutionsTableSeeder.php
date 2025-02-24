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
                'name' => 'Назарбаев Университет',
                'description1' => 'Назарбаев Университет — это ведущий международный исследовательский университет в Казахстане, основанный в 2010 году. Университет предлагает программы бакалавриата, магистратуры и докторантуры, следуя стандартам лучших мировых образовательных учреждений. Обучение ведётся на английском языке, а профессорско-преподавательский состав состоит из высококвалифицированных специалистов со всего мира.',
                'description2' => 'инновационный образовательный центр, созданный для подготовки высококвалифицированных специалистов в различных областях науки, инженерии, медицины и социальных наук. Университет поддерживает тесные связи с ведущими мировыми вузами и научными организациями, активно внедряя передовые технологии и методы обучения.',
                'description3' => 'Назарбаев Университет сочетает в себе академическую свободу, автономию и принцип меритократии. Здесь создаются уникальные условия для научных исследований и стартап-проектов, а выпускники становятся востребованными специалистами как в Казахстане, так и за его пределами.',
                'location' => 'Астана, Казахстан',
                'email'=> 'nu@nu.edu.kz',
                'phone'=> '+7 (7172) 70-66-88',
                'website' => 'https://nu.edu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Евразийский Национальный Университет имени Л.Н. Гумилёва',
                'description1' => 'Евразийский Национальный Университет имени Л.Н. Гумилёва (ЕНУ) — один из ведущих вузов Казахстана, основанный в 1996 году. Университет носит имя выдающегося историка и этнолога Льва Гумилёва, а его образовательные программы ориентированы на подготовку высококвалифицированных специалистов в различных областях науки, техники и гуманитарных дисциплин.',
                'description2' => 'ЕНУ имени Л.Н. Гумилёва — крупный научно-образовательный центр, активно участвующий в международных академических проектах и сотрудничестве с ведущими мировыми университетами. Университет предлагает широкий спектр программ бакалавриата, магистратуры и докторантуры, сочетая традиционные образовательные методы с современными технологиями.',
                'description3' => 'Евразийский Национальный Университет играет важную роль в развитии казахстанской науки и образования, поддерживая исследования в области истории, международных отношений, инженерии, IT и естественных наук. Университет известен своей сильной научной базой, академическими обменами и подготовкой специалистов, востребованных на мировом рынке труда.',
                'location' => 'Астана, Казахстан',
                'email'=> 'profenu@mail.ru',
                'phone'=> '+7 (7172) 70‒95‒00',
                'website' => 'https://enu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Казахский Агротехнический Университет имени Сакена Сейфуллина',
                'description1' => 'Казахский Агротехнический Университет имени Сакена Сейфуллина - Один из ведущих аграрных вузов Казахстана, готовящий специалистов в области сельского хозяйства, инженерии и экологии. Университет активно внедряет инновации в агропромышленный сектор.',
                'description2' => 'Университет имени Сакена Сейфуллина является центром научных исследований в области агротехнологий, устойчивого развития сельского хозяйства и цифровизации агропромышленного комплекса.',
                'description3' => 'Благодаря международному сотрудничеству, университет предлагает студентам возможность участия в обменных программах, стажировках и исследованиях в ведущих мировых аграрных институтах.',
                'location' => 'Астана, Казахстан',
                'email'=> 'office@kazatu.edu.kz',
                'phone'=> '8 (7172) 31 75 47',
                'website' => 'https://kazatu.edu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Медицинский Университет Астана',
                'description1' => 'Крупный медицинский вуз, специализирующийся на подготовке высококвалифицированных врачей, медсестер и научных работников в области здравоохранения.',
                'description2' => 'Университет активно внедряет современные медицинские технологии, симуляционное обучение и телемедицину, обеспечивая студентам передовую практическую подготовку.',
                'description3' => 'МУА сотрудничает с ведущими клиниками Казахстана и зарубежными медицинскими центрами, предоставляя студентам возможность прохождения практики и научных исследований на международном уровне.',
                'location' => 'Астана, Казахстан',
                'email'=> 'abiturient@amu.kz',
                'phone'=> '8 (7172) 53 95 12',
                'website' => 'https://amu.edu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Казахстанский Университет Экономики, Финансов и Международной Торговли',
                'description1' => 'Ведущий вуз в области экономики и финансов, готовящий специалистов по международной торговле, бухгалтерскому учету, налогообложению и бизнес-менеджменту.',
                'description2' => 'Университет предлагает образовательные программы, соответствующие мировым стандартам, и активно сотрудничает с международными финансовыми организациями.',
                'description3' => 'Вуз уделяет особое внимание подготовке кадров для государственных и частных структур, формируя лидеров в сфере экономики и международной торговли.',
                'location' => 'Астана, Казахстан',
                'email'=> 'mailbox@kuef.kz',
                'phone'=> '+7 (7172) 37-39-05',
                'website' => 'https://kuef.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Академия Государственного Управления при Президенте Республики Казахстан',
                'description1' => 'Академия является главным учебным центром страны по подготовке государственных служащих, ориентированных на эффективное управление и развитие государственных институтов.',
                'description2' => 'Учебные программы Академии разработаны с учетом международных стандартов и опыта ведущих управленческих школ мира.',
                'description3' => 'Академия активно взаимодействует с госорганами, бизнесом и международными партнерами, обеспечивая подготовку лидеров нового поколения в сфере госуправления.',
                'location' => 'Астана, Казахстан',
                'email'=> 'admission@apa.kz',
                'phone'=> '+7 (7172) 75 32 68',
                'website' => 'https://pa-academy.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Университет КАЗГЮУ',
                'description1' => 'Один из лучших юридических вузов Казахстана, известный высоким уровнем подготовки специалистов в области права, международных отношений и бизнеса.',
                'description2' => 'Университет сотрудничает с ведущими мировыми образовательными учреждениями, предоставляя студентам доступ к лучшим мировым практикам в области юриспруденции.',
                'description3' => 'КАЗГЮУ отличается высоким уровнем трудоустройства выпускников и тесными связями с юридическими фирмами, госструктурами и международными организациями.',
                'location' => 'Астана, Казахстан',
                'email'=> 'info@mnu.kz',
                'phone'=> '8 (7172) 70 30 30',
                'website' => 'https://kazguu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Международный Университет Астаны',
                'description1' => 'Университет ориентирован на подготовку специалистов международного уровня в различных сферах науки, техники и бизнеса.',
                'description2' => 'Вуз активно участвует в международных образовательных проектах и обменах, давая студентам возможность обучения за рубежом.',
                'description3' => 'Международный Университет Астаны развивает междисциплинарные исследования, привлекая ведущих специалистов и профессоров со всего мира.',
                'location' => 'Астана, Казахстан',
                'email'=> 'info@aiu.edu.kz',
                'phone'=> '8 (7172) 47 66 77',
                'website' => 'https://mui.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Астана IT Университет',
                'description1' => 'Астана IT Университет это специализированный вуз, занимающийся подготовкой ИТ-специалистов, разработчиков программного обеспечения, кибербезопасников и инженеров данных.',
                'description2' => 'Университет тесно сотрудничает с технологическими компаниями и стартапами, предоставляя студентам возможность прохождения практики и трудоустройства в ведущих ИТ-компаниях.',
                'description3' => 'Астана IT Университет внедряет передовые методы обучения, включая онлайн-курсы, VR-технологии и искусственный интеллект.',
                'location' => 'Астана, Казахстан',
                'email'=> 'astanait@mail.ru',
                'phone'=> '+7 (7172) 64‒57‒17',
                'website' => 'https://astanait.edu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Казахстанский Университет Технологии и Бизнеса',
                'description1' => 'Университет готовит специалистов в области информационных технологий, инженерии и управления бизнесом, ориентируясь на современные рыночные требования.',
                'description2' => 'Вуз активно внедряет практико-ориентированные образовательные программы, сотрудничая с крупнейшими предприятиями Казахстана.',
                'description3' => 'Особое внимание в университете уделяется цифровым технологиям, логистике и инновационному бизнес-управлению.',
                'location' => 'Астана, Казахстан',
                'email'=> 'akutb@mail.ru',
                'phone'=> '8 (7172) 72-58-15',
                'website' => 'https://kutb.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Университет «Туран-Астана»',
                'description1' => 'Университет специализируется на подготовке кадров в сфере бизнеса, туризма, медиа, маркетинга и менеджмента.',
                'description2' => '«Туран-Астана» активно развивает программы двойных дипломов и международные стажировки.',
                'description3' => 'Вуз ориентирован на практическое обучение, сотрудничая с ведущими казахстанскими и международными компаниями.',
                'location' => 'Астана, Казахстан',
                'email'=> 'admissions@tau-edu.kz',
                'phone'=> '8 (7172) 64 43 11',
                'website' => 'tau-edu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Казахский национальный университет искусств',
                'description1' => 'Ведущий вуз страны по подготовке специалистов в области музыки, театра, изобразительного искусства и кинематографии.',
                'description2' => 'Университет предоставляет студентам возможность обучаться у известных мастеров искусства и участвовать в международных конкурсах.',
                'description3' => 'КазНУИ является центром культурных инициатив, объединяя творчество, научные исследования и современные технологии.',
                'location' => 'Астана, Казахстан',
                'email'=> 'Kaznui.priem@gmail.com',
                'phone'=> '8 (7172) 70 55 35',
                'website' => 'kaznui.edu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Казахская национальная академия хореографии',
                'description1' => 'Первый в Центральной Азии вуз, специализирующийся на подготовке профессиональных артистов балета, хореографов и педагогов.',
                'description2' => 'Академия обучает студентов по международным стандартам, предоставляя возможность стажировок в ведущих мировых балетных театрах.',
                'description3' => 'В стенах академии сочетаются традиционные казахские танцы и современные хореографические тенденции.',
                'location' => 'Астана, Казахстан',
                'email'=> 'info@balletacademy.kz',
                'phone'=> '+7 (7172) 79‒85‒70',
                'website' => 'balletacademy.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Карагандинский университет Казпотребсоюза, филиал в г. Астана',
                'description1' => 'Филиал ведущего экономического университета Казахстана, готовящий специалистов в области менеджмента, маркетинга, финансов и бухгалтерского учета.',
                'description2' => 'Университет предлагает программы, ориентированные на развитие малого и среднего бизнеса, а также государственных структур.',
                'description3' => 'Образование в вузе сочетается с исследовательской работой и практическими проектами в сфере экономики и предпринимательства.',
                'location' => 'Астана, Казахстан',
                'email'=> '+7 (7172) 50‒18‒31',
                'phone'=> 'keu@mail.ru',
                'website' => 'www.keu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Казахстанский филиал МГУ им. М.В.Ломоносова',
                'description1' => 'Филиал одного из лучших университетов мира, предоставляющий образование мирового уровня в различных дисциплинах.',
                'description2' => 'Программы обучения соответствуют стандартам Московского государственного университета, что обеспечивает высокий уровень подготовки специалистов.',
                'description3' => 'Выпускники филиала востребованы как в Казахстане, так и за рубежом, благодаря признанному международному диплому МГУ.',
                'location' => 'Астана, Казахстан',
                'email'=> 'otvet@msu.kz',
                'phone'=> '8 (7172) 35 43 87',
                'website' => 'www.msu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Национальный университет обороны Республики Казахстан',
                'description1' => 'Главный военный вуз страны, осуществляющий подготовку офицеров и руководящих кадров Вооруженных Сил Казахстана.',
                'description2' => 'Университет проводит обучение на основе современных стратегий национальной безопасности и военной науки.',
                'description3' => 'Преподавательский состав включает ведущих военных экспертов и специалистов по обороне.',
                'location' => 'Астана, Казахстан',
                'email'=> '',
                'phone'=> '',
                'website' => 'https://www.apa.kz/ru/',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Esil University',
                'description1' => 'Университет специализируется на обучении в сферах экономики, финансов, менеджмента и цифровых технологий.',
                'description2' => 'Вуз предлагает программы бакалавриата и магистратуры, ориентированные на развитие профессиональных навыков.',
                'description3' => 'Esil University активно сотрудничает с международными компаниями и академическими учреждениями.',
                'location' => 'Астана, Казахстан',
                'email'=> 'nuo@mail.ru',
                'phone'=> '+7 (7172) 26‒36‒79',
                'website' => 'nuo.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
            [
                'name' => 'Евразийский гуманитарный институт имени А. Кусаинова',
                'description1' => 'Университет специализируется на подготовке специалистов в области права, педагогики, психологии и международных отношений.',
                'description2' => 'Вуз предлагает инновационные образовательные программы с учетом современных требований рынка труда.',
                'description3' => 'ЕГИ активно участвует в научных исследованиях и международных образовательных проектах.',
                'location' => 'Астана, Казахстан',
                'email'=> 'eagi_pk@egi.edu.kz',
                'phone'=> '8 (7172) 56 22 00',
                'website' => 'egi.edu.kz',
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 60)),
            ],
        ]);


    }
}
