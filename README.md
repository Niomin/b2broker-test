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
