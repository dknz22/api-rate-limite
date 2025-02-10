# API Rate Limiter System

Этот проект представляет собой тестовую систему для работы с API-ограничениями (rate limiting) и логированием превышения лимитов. Проект создан для портфолио и демонстрирует использование Laravel 11 для реализации rate limiting и логирования.

## Описание

Проект включает следующие функции:
- **Rate Limiting**: Ограничение количества запросов к API (60 запросов в минуту для каждого IP-адреса).
- **Логирование**: Запись в базу данных информации о превышении лимитов (IP-адрес, эндпоинт, количество превышений).

## Установка

### 1. Клонирование репозитория

Склонируйте репозиторий на ваш компьютер:

```bash
git clone https://github.com/dknz22/api-rate-limiter.git
cd api-rate-limiter

### 2. Установка зависимостей

Установите все зависимости через Composer:

```bash
composer install
```

### 3. Настройка окружения

Скопируйте файл .env.example в .env:
```bash
cp .env.example .env
```

Настройте подключение к базе данных:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Генерация ключа приложения

```bash
php artisan key:generate
```

### 5. Запуск миграций

```bash
php artisan migrate
```

## Использование
Проект включает тестовый маршрут /api/test, который ограничен 60 запросами в минуту. Чтобы протестировать rate limiting:

- Отправьте GET-запрос на http://127.0.0.1:8000/api/test.
- После 60 запросов в течение минуты вы получите ответ 429 Too Many Requests.
- Превышения лимитов будут записаны в таблицу rate_limit_logs.

### Просмотр логов (rate_limit_logs table)

| Title        | Example Value           |
| ------------- |:-------------:|
| id | 1 |
| ip_address | 127.0.0.1 |
| endpoint | /test |
| hits | 5 |
| created_at | 2023-10-01 12:00:00 |
| updated_at | 2023-10-01 12:00:00 |
