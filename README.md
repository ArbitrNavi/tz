# Документация для `ApplicationController`

## Методы Контроллера

### Метод: `store`

**Описание:** Метод `store` принимает POST-запрос для создания новой заявки.

**Параметры запроса:**
- `ApplicationCreateRequest $request` - объект запроса, содержащий данные о новой заявке.

**Ответ:**
- В случае успешного создания заявки, метод возвращает JSON-ответ с данными созданной заявки.

### Метод: `update`

**Описание:** Метод `update` обрабатывает PUT-запрос для обновления существующей заявки.

**Параметры запроса:**
- `Request $request` - объект запроса, содержащий данные об обновлении заявки.
- `$id` - уникальный идентификатор заявки, которую необходимо обновить.

**Ответ:**
- В случае успешного обновления заявки, метод возвращает JSON-ответ с сообщением "Заявка успешно обновлена".

### Метод: `index`

**Описание:** Метод `index` обрабатывает GET-запрос для получения списка заявок.

**Параметры запроса:**
- `$status` (необязательный) - статус заявок, по которому необходимо фильтровать список. Если не указан, возвращаются все заявки.

**Ответ:**
- Метод возвращает JSON-ответ со списком заявок, соответствующих заданному статусу (если указан) или всех заявок (если не указан).

## Пример использования

### Создание новой заявки

```http request
POST /api/requests

{
    "name": "Иван",
    "email": "ivan@example.com",
    "status": "Active",
    "message": "Прошу рассмотреть мою заявку."
}

Ответ

{
    "data": {
        "id": 1,
        "name": "Иван",
        "email": "ivan@example.com",
        "status": "Active",
        "message": "Прошу рассмотреть мою заявку.",
        "created_at": "2023-09-05 10:00:00",
        "updated_at": "2023-09-05 10:00:00"
    }
}

``` 

```http request
PUT /api/requests/1

{
    "comment": "Заявка рассмотрена и принята."
}

Ответ

{
    "message": "Заявка успешно обновлена"
}
```

```http request
GET /api/requests

[
    {
        "id": 1,
        "name": "Иван",
        "email": "ivan@example.com",
        "status": "Active",
        "message": "Прошу рассмотреть мою заявку.",
        "created_at": "2023-09-05 10:00:00",
        "updated_at": "2023-09-05 10:00:00"
    },
    {
        "id": 2,
        "name": "Мария",
        "email": "maria@example.com",
        "status": "Resolved",
        "message": "Заявка рассмотрена и принята.",
        "created_at": "2023-09-05 10:30:00",
        "updated_at": "2023-09-05 10:35:00"
    }
]

Для фильтрации заявок
GET /api/requests/active|resolved


[
    {
        "id": 1,
        "name": "Иван",
        "email": "ivan@example.com",
        "status": "active|resolved",
        "message": "Прошу рассмотреть мою заявку.",
        "created_at": "2023-09-05 10:00:00",
        "updated_at": "2023-09-05 10:00:00"
    },
]
```





