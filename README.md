Не захотелось выкладывать на https://packagist.org/, так что установка на одну строчку больше (во-первых, из-за нежелания мусорить. Во-вторых, на случай, если захочется сделать пакет приватным).

Добавить в composer.json
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/niomin/b2broker-test"
    }
]
```
И в require:
```"niomin/b2broker-test": "dev-master"```
    
Затем выполнить
```
php artisan vendor:publish
php artisan migrate
```
В `config/b2broker.php` можно настроить:
1. ttl: время жизни заявки в секундах 
2. route.prefix: префикс для всех урлов
3. db: имя таблицы и имя коннекшена
4. repositoryClass: класс для работы с репозиторием, если не устроит стандартная имплементация

После этого приложение будет работать, доступно по путям 
`/{prefix}/{id}` -- просмотр
`/{prefix}/create?text=Your%20text` -- создание
`/{prefix}/delete/{id}` -- удаление
`/{prefix}/update/{id}?text=New%20text` -- обновление
