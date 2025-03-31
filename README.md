# Berufsberatung — система профориентации

## Описание проекта
Berufsberatung — это веб-приложение на Laravel, предназначенное для профориентации и управления информацией об образовательных учреждениях. Платформа позволяет пользователям изучать доступные институты, их местоположение, специальности и события, а также следить за жизнью университетов.  

Этот проект представляет собой **административную панель**, которая предоставляет удобный интерфейс для управления данными образовательных учреждений, редактирования информации, добавления новых учебных заведений, их программ и мероприятий. Панель администратора обеспечивает эффективное администрирование контента, управление пользователями и настройку параметров системы.

## Функциональность
- Просмотр информации для поступления
- Детальная информация об институтах, специальностях и мероприятиях
  - Название, описание, местоположение, сайт
  - Перечень предлагаемых специальностей, сгруппированных по квалификациям
  - Отображение стоимости и длительности обучения
- Адаптивный и стильный UI

## Технологии
- **Backend:** Laravel (PHP)
- **Frontend:** Blade, HTML, CSS
- **База данных:** MySQL / PostgreSQL (на выбор)
- **Стили:** CSS (включая анимации и адаптивный дизайн)

## Установка и настройка

### 1. Клонирование репозитория
```sh
git clone https://github.com/your-username/institution-management.git
cd institution-management
```

### 2. Установка зависимостей
```sh
composer install
npm install
```

### 3. Настройка переменных окружения
Создайте файл `.env`, скопировав `.env.example`:
```sh
cp .env.example .env
```
Настройте в `.env` параметры подключения к базе данных:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Генерация ключа приложения
```sh
php artisan key:generate
```

### 5. Запуск миграций и сидов
```sh
php artisan migrate --seed
```

### 6. Запуск локального сервера
```sh
php artisan serve
```
Приложение будет доступно по адресу `http://127.0.0.1:8000`.


## Cкриншоты
## страница входа
![Скриншот страницы регистрации](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/loginPage.png)

## главная страница
![Скриншот главной страницы](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/mainPage1.png)
![Скриншот главной страницы](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/mainPage2.png)
![Скриншот главной страницы](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/mainPage3.png)

## страница уведомлений
![Скриншот страницы уведомлений](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/notificationsPage.png)

## страницы заявок
![Скриншот страницы заявок](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/institutionApplications.png)
![Скриншот страницы заявок](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/userApplications.png)
![Скриншот страницы заявок](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/userApplicationsFilter.png)

## страница отзывов
![Скриншот страницы отзывов](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/reviewsPage.png)

## страница институтов
![Скриншот страницы институтов](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/institutionsPage.png)
![Скриншот страницы институтов](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/institutionsAbout.png)
![Скриншот страницы институтов](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/institutionsEdit.png)

## страница глобальных специальностей
![Скриншот страницы глобальных специальностей](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/globalSpecialitiesPage.png)

## страница квалификаций
![Скриншот страницы квалификаций](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/qualificationsPage.png)

## страница специальностей
![Скриншот страницы спецаильностей](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/specialitiesPage.png)



## Структура проекта
```
/diplomTEST
├── app/                             # Основная бизнес-логика (модели, контроллеры)
│   ├── Http/                        # HTTP-логика (контроллеры, middleware)
│   │   ├── Controllers/            # Контроллеры приложения
│   │   │   ├── ApplicationController.php
│   │   │   ├── AuthController.php
│   │   │   ├── ChartController.php
│   │   │   ├── Controller.php
│   │   │   ├── DashboardController.php
│   │   │   ├── EventsCalendarController.php
│   │   │   ├── GlobalSpecialtyController.php
│   │   │   ├── GrantController.php
│   │   │   ├── HomeController.php
│   │   │   ├── InstitutionController.php
│   │   │   ├── LikeController.php
│   │   │   ├── NotificationController.php
│   │   │   ├── QualificationController.php
│   │   │   ├── ReviewController.php
│   │   │   ├── SpecializationController.php
│   │   │   └── UserController.php
│   │   └── Middleware/             # Middleware приложения
│   │       └── RedirectIfAuthenticated.php
│   ├── Models/                     # Модели приложения
│   │   ├── Admin.php
│   │   ├── Application.php
│   │   ├── EventsCalendar.php
│   │   ├── GlobalSpecialty.php
│   │   ├── Grant.php
│   │   ├── Institution.php
│   │   ├── InstitutionSpecialty.php
│   │   ├── Like.php
│   │   ├── Notification.php
│   │   ├── Qualification.php
│   │   ├── Review.php
│   │   ├── Specialization.php
│   │   └── User.php
│   └── Providers/                  # Провайдеры приложения
│       └── AppServiceProvider.php
├── bootstrap/                       # Файлы начальной загрузки приложения
├── config/                          # Конфигурационные файлы
├── database/                        # Миграции, сидеры и фабрики данных
│   ├── factories/                  # Фабрики данных
│   │   ├── AdminFactory.php
│   │   ├── ApplicationFactory.php
│   │   ├── EventsCalendarFactory.php
│   │   ├── GlobalSpecialtyFactory.php
│   │   ├── GrantFactory.php
│   │   ├── InstitutionFactory.php
│   │   ├── LikeFactory.php
│   │   ├── NotificationFactory.php
│   │   ├── QualificationFactory.php
│   │   ├── ReviewFactory.php
│   │   └── UserFactory.php
│   ├── migrations/                 # Миграции базы данных
│   │   ├── 2025_02_03_155303_create_institutions_table.php
│   │   ├── 2025_02_03_155303_create_users_table.php
│   │   ├── 2025_02_03_155304_create_events_calendar_table.php
│   │   ├── 2025_02_03_155304_create_notifications_table.php
│   │   ├── 2025_02_03_155305_create_global_specialties_table.php
│   │   ├── 2025_02_03_155306_create_grants_table.php
│   │   ├── 2025_02_03_155306_create_reviews_table.php
│   │   ├── 2025_02_03_155307_create_likes_table.php
│   │   ├── 2025_02_03_155523_create_applications_table.php
│   │   ├── 2025_02_03_162054_create_admins_table.php
│   │   ├── 2025_02_05_053839_create_sessions_table.php
│   │   ├── 2025_02_07_101953_add_is_banned_to_users_table.php
│   │   ├── 2025_02_13_153355_create_qualifications_table.php
│   │   ├── 2025_02_13_165733_create_specializations_table.php
│   │   ├── 2025_02_15_105125_create_institution_specialties_table.php
│   │   └── 2025_02_18_114615_add_duration_to_institution_specialties.php
│   ├── seeders/                    # Сидеры для заполнения базы данных
│   │   ├── AdminsTableSeeder.php
│   │   ├── ApplicationsTableSeeder.php
│   │   ├── DatabaseSeeder.php
│   │   ├── EventsCalendarTableSeeder.php
│   │   ├── GlobalSpecialtiesTableSeeder.php
│   │   ├── GrantsTableSeeder.php
│   │   ├── InstitutionSpecialtiesSeeder.php
│   │   ├── InstitutionsTableSeeder.php
│   │   ├── LikesTableSeeder.php
│   │   ├── NotificationsTableSeeder.php
│   │   ├── QualificationsTableSeeder.php
│   │   ├── ReviewsTableSeeder.php
│   │   ├── SpecialtiesSeeder.php
│   │   └── UsersTableSeeder.php
│   ├── .gitignore
│   └── database.sqlite
├── public/                          # Статические файлы (CSS, JS, изображения)
│   ├── .htaccess
│   ├── application-icon.svg
│   ├── B_B.png
│   ├── B_B.svg
│   ├── events-icon.svg
│   ├── favicon.ico
│   ├── home-icon.svg
│   ├── index.php
│   ├── notification-icon.svg
│   ├── robots.txt
│   └── users-icon.svg
├── resources/                       # Ресурсы приложения (шаблоны, стили, скрипты)
│   ├── css/                        # CSS-файлы
│   ├── js/                         # JavaScript-файлы
│   └── views/                      # Blade-шаблоны
│       ├── applications/           # Шаблоны для заявок
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── auth/                   # Шаблоны для аутентификации
│       │   └── login.blade.php
│       ├── events_calendar/        # Шаблоны для календаря событий
│       │   ├── about.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── global_specialties/     # Шаблоны для глобальных специальностей
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── grants/                 # Шаблоны для грантов
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── institutions/           # Шаблоны для учреждений
│       │   ├── about.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── layouts/                # Основные макеты
│       │   ├── app.blade.php
│       │   └── sidebar.blade.php
│       ├── likes/                  # Шаблоны для лайков
│       │   └── index.blade.php
│       ├── notification/           # Шаблоны для уведомлений
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── qualifications/         # Шаблоны для квалификаций
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── reviews/                # Шаблоны для отзывов
│       │   └── index.blade.php
│       ├── specializations/        # Шаблоны для специализаций
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── users/                  # Шаблоны для пользователей
│       │   └── index.blade.php
│       ├── vendor/                 # Шаблоны пагинации
│       │   └── pagination/
│       │       ├── bootstrap-4.blade.php
│       │       ├── bootstrap-5.blade.php
│       │       ├── default.blade.php
│       │       ├── semantic-ui.blade.php
│       │       ├── simple-bootstrap-4.blade.php
│       │       ├── simple-bootstrap-5.blade.php
│       │       ├── simple-default.blade.php
│       │       ├── simple-tailwind.blade.php
│       │       └── tailwind.blade.php
│       └── home.blade.php          # Главная страница
├── routes/                         # Файлы маршрутов
│   ├── console.php
│   └── web.php
├── storage/                        # Файлы хранилища (логи, кэш, загруженные файлы)
│   ├── app/                        # Приватные файлы
│   │   ├── private/
│   │   └── public/
│   ├── framework/                  # Фреймворк-файлы
│   └── logs/                       # Логи приложения
├── tests/                          # Тесты приложения
├── vendor/                         # Зависимости Composer
├── .editorconfig                   # Конфигурация редактора
├── .env                            # Файл конфигурации окружения
├── .env.example                    # Пример файла конфигурации окружения
├── .gitattributes                  # Атрибуты Git
├── .gitignore                      # Игнорируемые файлы Git
├── artisan                         # Консольные команды Laravel
├── composer.json                   # Список зависимостей PHP
├── composer.lock                   # Лок-файл Composer
├── package.json                    # Список зависимостей Node.js
├── phpunit.xml                     # Конфигурация PHPUnit
├── postcss.config.js               # Конфигурация PostCSS
├── README.md                       # Документация проекта
├── tailwind.config.js              # Конфигурация Tailwind CSS
└── vite.config.js                  # Конфигурация Vite
```




## Контакты
Автор: **Ахметов Рауан**    
Email: rauan.az.2006@gmail.com

#   B e r u f s b e r a t u n g - F r o n t  
 #   B e r u f s b e r a t u n g - F r o n t  
 # Berufsberatung-Laravel
