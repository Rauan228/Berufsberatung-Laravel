# Berufsberatung — Административная панель системы профориентации

## Введениe
В условиях стремительного развития информационных технологий и цифровизации всех сфер жизни особое внимание уделяется вопросам профессиональной ориентации молодежи. Для молодых людей, стоящих перед выбором будущей профессии и учебного заведения, важно иметь доступ к достоверной и актуальной информации, которая поможет принять взвешенное решение. Однако информация в интернете зачастую разрознена, сложна для восприятия и не учитывает индивидуальные предпочтения абитуриентов.

Проект **"B/B" (Berufsberatung)** — это веб-приложение, разработанное на Laravel 11, целью которого является помощь молодым людям в определении учебного ориентира, выборе учебного заведения и знакомстве с возможными специальностями. Данный репозиторий представляет собой **административную панель**, обеспечивающую управление данными системы, включая учебные заведения, специальности, мероприятия и пользователей. Панель создана с учетом современных требований к программным продуктам: удобный интерфейс, адаптивность и высокая функциональность.

### Актуальность темы
Выбор профессии — важный этап в жизни каждого человека. Недостаточная осведомленность о специальностях и учебных заведениях может привести к неверному выбору, что негативно скажется на карьере и удовлетворенности жизнью. "B/B" решает эту проблему, предоставляя централизованную платформу для поиска, анализа и управления информацией об образовательных учреждениях.

### Цель работы
Целью проекта является разработка административной панели веб-приложения "B/B", которая позволяет:
- Управлять информацией об учебных заведениях, включая их местоположение на карте.
- Фильтровать заведения по специальностям, грантам, общежитиям и другим параметрам.
- Модерировать данные о специальностях и мероприятиях.
- Повышать осведомленность молодежи о доступных образовательных возможностях.

---

## Описание проекта

### Постановочная часть

#### Формулировка задачи
В условиях роста количества образовательных учреждений и цифровизации перед абитуриентами стоит сложная задача выбора учебного заведения и специальности. Разрозненность информации и отсутствие удобных инструментов для управления данными затрудняют этот процесс. Административная панель "B/B" обеспечивает централизованный доступ к информации о вузах и колледжах, их направлениях подготовки и условиях поступления.

**Цели панели:**
- Обеспечить управление учебными заведениями, специальностями, мероприятиями и пользователями.
- Предоставить администраторам инструменты для фильтрации, модерации и анализа данных.
- Интегрировать картографические сервисы и мультиязычную поддержку.
- Повысить эффективность взаимодействия между пользователями и представителями заведений.

**Задачи разработки:**
1. Разработать структуру базы данных для хранения информации об учебных заведениях, специальностях, мероприятиях и пользователях.
2. Реализовать систему фильтрации учебных заведений по ключевым параметрам.
3. Внедрить поиск специальностей по ключевым словам.
4. Интегрировать картографический сервис для отображения заведений и расчета маршрутов.
5. Обеспечить авторизацию и управление пользователями.
6. Создать интерфейс для представителей учебных заведений.
7. Реализовать систему обработки заявок и обратной связи.
8. Внедрить рейтинговую систему на основе отзывов.

#### Описание входных и выходных данных
**Входные данные:**
- Данные об учебных заведениях: название, тип, адрес, контакты, наличие общежития/грантов.
- Данные о специальностях: название, описание, список заведений.
- Данные о мероприятиях: название, дата, место, описание.
- Данные пользователей: имя, email, пароль,.
- Ключевые слова для поиска.
- Геолокационные данные.
- Отзывы и оценки.

**Выходные данные:**
- Фильтрованные списки учебных заведений.
- Детальная информация о заведениях (описание, контакты, специальности, отзывы).
- Списки мероприятий с возможностью подачи заявок.
- Интерактивные карты с маршрутами.
- Уведомления о статусе заявок.
- Рейтинг заведений.
- Личный кабинет с избранным.

---

## Технологии
- **Backend:** Laravel 11 (PHP)
- **Frontend:** Blade
- **База данных:** MySQL
- **Инструменты:** Composer, npm, Vite

---

## Установка и настройка

### Требования
- PHP 8.3 или выше
- Composer
- Node.js (18.x или выше) и npm
- MySQL

### Инструкция по установке

#### 1. Клонирование репозитория
```sh
git clone https://github.com/Rauan228/Berufsberatung-Laravel.git
cd Berufsberatung-Laravel
```

#### 2. Установка зависимостей
```sh
composer install
npm install
```

#### 3. Настройка переменных окружения
Скопируйте файл `.env.example` в `.env`:
```sh
cp .env.example .env
```
Настройте параметры базы данных в `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=berufsberatung_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### 4. Генерация ключа приложения
```sh
php artisan key:generate
```

#### 5. Запуск миграций и сидов
```sh
php artisan migrate --seed
```

#### 6. Сборка фронтенда
```sh
npm run build
```

#### 7. Запуск локального сервера
```sh
php artisan serve
```
Панель будет доступна по адресу `http://127.0.0.1:8000`.

---

## Скриншоты

### Страница входа
![Страница входа](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/loginPage.png)

### Главная страница
![Главная страница 1](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/mainPage1.png)
![Главная страница 2](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/mainPage2.png)
![Главная страница 3](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/mainPage3.png)

### Страница уведомлений
![Страница уведомлений](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/notificationsPage.png)

### Страницы заявок
![Заявки учреждений](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/institutionApplications.png)
![Заявки пользователей](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/userApplications.png)
![Фильтр заявок](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/userApplicationsFilter.png)

### Страница отзывов
![Страница отзывов](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/reviewsPage.png)

### Страница институтов
![Список институтов](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/institutionsPage.png)
![О заведении](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/institutionsAbout.png)
![Редактирование](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/institutionsEdit.png)

### Страница глобальных специальностей
![Глобальные специальности](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/globalSpecialitiesPage.png)

### Страница квалификаций
![Квалификации](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/qualificationsPage.png)

### Страница специальностей
![Специальности](https://github.com/Rauan228/Berufsberatung-Laravel/blob/main/public/screenshots/specialitiesPage.png)

---

## Структура проекта

```
/Berufsberatung-Laravel
├── app/                             # Бизнес-логика
│   ├── Http/Controllers/           # Контроллеры
│   ├── Models/                     # Модели
│   └── Providers/                  # Сервис-провайдеры
├── bootstrap/                       # Начальная загрузка
├── config/                          # Конфигурации
├── database/                        # База данных
│   ├── factories/                  # Фабрики
│   ├── migrations/                 # Миграции
│   │   ├── 2025_02_03_155303_create_institutions_table.php
│   │   ├── 2025_02_03_155303_create_users_table.php
│   │   ├── 2025_02_03_155304_create_events_calendar_table.php
│   │   ├── 2025_02_03_155304_create_notifications_table.php
│   │   ├── 2025_02_03_155305_create_global_specialties_table.php
│   │   ├── 2025_02_03_155306_create_grants_table.php
│   │   ├── 2025_02_03_155306_create_reviews_table.php
│   │   ├── 2025_02_03_155307_create_likes_table.php
│   │   ├── 2025_02_03_162054_create_admins_table.php
│   │   ├── 2025_02_05_053839_create_sessions_table.php
│   │   ├── 2025_02_07_101953_add_is_banned_to_users_table.php
│   │   ├── 2025_02_13_153355_create_qualifications_table.php
│   │   ├── 2025_02_13_165733_create_specializations_table.php
│   │   ├── 2025_02_15_105125_create_institution_specialties_table.php
│   │   ├── 2025_02_18_114615_add_duration_to_institution_specialties.php
│   │   ├── 2025_02_20_182555_create_personal_access_tokens_table.php
│   │   ├── 2025_02_24_135459_create_user_applications_table.php
│   │   ├── 2025_02_24_135515_create_institution_applications_table.php
│   │   └── 2025_02_28_164303_add_fields_to_institutions_table.php
│   └── seeders/                    # Сидеры
├── public/                          # Статические файлы
│   └── screenshots/                # Скриншоты
├── resources/                       # Ресурсы
│   ├── css/                        # Стили
│   ├── js/                         # Скрипты
│   └── views/                      # Blade-шаблоны
├── routes/                         # Маршруты
├── storage/                        # Хранилище
├── tests/                          # Тесты
├── vendor/                         # Зависимости Composer
├── .editorconfig                   # Настройки редактора
├── .env                            # Переменные окружения
├── .env.example                    # Пример .env
├── .gitignore                      # Игнорируемые файлы
├── artisan                         # Команды Laravel
├── composer.json                   # Зависимости PHP
├── composer.lock                   # Лок Composer
├── package.json                    # Зависимости Node.js
├── phpunit.xml                     # Конфигурация тестов
├── postcss.config.js               # Конфигурация PostCSS
├── README.md                       # Документация
├── tailwind.config.js              # Конфигурация Tailwind
└── vite.config.js                  # Конфигурация Vite
```

---
