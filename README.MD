# HTMLParser

## Установка
```
composer install
```

### Использование
- Запускаем API через 
````
php -S 127.0.0.1
````
- API получает *GET* запрос с параметром *url* (ссылка страницы), который нуждается в парсинге 
```
http://127.0.0.1:8000?url=https://somesite.com/
```
- Результатом запроса возвращается json ответ, с телом:
```
{
    "status": "success",
    "result": {
        "<html>": 3,
        "<head>": 2,
        "<meta>": 3,
        "<link>": 12,
        "<script>": 4,
        "<title>": 2,
        "<body>": 2,
        "<div>": 110,
        "<a>": 44,
        "<img>": 37,
        "<p>": 112,
        "<ul>": 12,
        "<li>": 52,
        "<span>": 30,
        "<br>": 9,
        "<button>": 4,
        "<header>": 2,
        "<form>": 2,
        "<input>": 2,
    }
}
```

### Контакты для связи
- go.suits.3@gmail.com
- t.me/@muhammet210195

