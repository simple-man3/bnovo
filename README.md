## Локальный запуск

```sh
composer i
cp .env.example .env
php artisan key:generate
```

Необходимо прописать параметры в .env файле

| Атрибут       | Значение |
|---------------|----------|
| DB_CONNECTION | mysql    |
| DB_HOST       | mysql    |
| DB_PORT       | 3306     |
| DB_DATABASE   | bnovo    |
| DB_USERNAME   | sail     |
| DB_PASSWORD   | password |

Чтобы запустить контейнеры сервиса
```sh
./vendor/bin/sail up -d
```

Чтобы остановить сервис
```sh
./vendor/bin/sail down
```

Доменное имя сервиса: [localhost][domain]

Убедиться, что сервис работает: [localhost/up][domain-heal]

На данный момент обслуживаются только 3 номера стран:

- Россия: +7
- США: +1
- Британия: +44

## Список апи

| Api               | Метод  | Описание         |
|-------------------|--------|------------------|
| api/v1/guest/{id} | GET    | Получение записи |
| api/v1/guest      | POST   | Создание         |
| api/v1/guest      | PATCH  | Редактирование   |
| api/v1/guest      | DELETE | Удаление         |

## Описание апи

### GET api/v1/guest/{id}

Параметр id это идентификатор записи из таблицы guests

Ответ

```sh
{
    "data": {
        "id": 5,
        "first_name": "text",
        "last_name": "asa",
        "email": "custoMqs@gmail.com",
        "phone": "+442012345678",
        "country": "uk",
        "created_at": "2024-09-27T20:34:07.000000Z",
        "updated_at": "2024-09-27T20:34:07.000000Z"
    }
}
```

### POST api/v1/guest

Тело запроса

| Параметр   | Обязателен | Перечисление   |
|------------|------------|----------------|
| first_name | да         | -              |
| last_name  | да         | -              |
| email      | да         | -              |
| phone      | да         | -              |
| country    | нет        | ru, usa, uk    |

Пример

```sh
{
    "first_name": "firstName",
    "last_name": "lastName",
    "email": "example@gmail.com",
    "phone": "+442012345678",
    "country": "uk"
}
```

Ответ

```sh
{
    "data": {
        "id": 5,
        "first_name": "text",
        "last_name": "asa",
        "email": "custoMqs@gmail.com",
        "phone": "+442012345678",
        "country": "uk",
        "created_at": "2024-09-27T20:34:07.000000Z",
        "updated_at": "2024-09-27T20:34:07.000000Z"
    }
}
```

### PATCH api/v1/guest/{id}

Тело запроса

| Параметр   | Обязателен | Перечисление   |
|------------|------------|----------------|
| first_name | нет        | -              |
| last_name  | нет        | -              |
| email      | нет        | -              |
| phone      | нет        | -              |
| country    | нет        | ru, usa, uk    |

Пример

```sh
{
    "first_name": "firstName",
    "last_name": "lastName",
    "email": "example@gmail.com",
    "phone": "+442012345678"
}
```

Ответ

```sh
{
    "data": {
        "id": 5,
        "first_name": "text",
        "last_name": "asa",
        "email": "custoMqs@gmail.com",
        "phone": "+442012345678",
        "country": "uk",
        "created_at": "2024-09-27T20:34:07.000000Z",
        "updated_at": "2024-09-27T20:34:07.000000Z"
    }
}
```

[domain]: <http:localhost>
[domain-heal]: <http:localhost/up>
