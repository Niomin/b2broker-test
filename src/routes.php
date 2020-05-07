<?php

use Illuminate\Support\Facades\Route;

Route::get('b2broker', function () {
    echo 'Hello from the B2BrokerTest package!';
});

//В best practices предлагали хардкодить имя класса в строку, но меня слишком корёжило от внешнего вида.
$router = \Niomin\B2BrokerTest\Http\Controllers\B2BrokerController::class;


Route::get('b2broker/{id}', $router . '@read')->where('id', '[0-9]+');

Route::get('b2broker/create', $router . '@create');

Route::get('b2broker/update/{id}', $router . '@update')->where('id', '[0-9]+');

Route::get('b2broker/delete/{id}', $router . '@delete')->where('id', '[0-9]+');
