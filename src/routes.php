<?php

use Illuminate\Support\Facades\Route;

//В best practices предлагали хардкодить имя класса в строку, но меня слишком корёжило от внешнего вида.
$router = \Niomin\B2BrokerTest\Http\Controllers\B2BrokerController::class;

$prefix = config('b2broker.route.prefix');

Route::get($prefix, $router . '@index');

Route::get($prefix . '/{id}', $router . '@read')->where('id', '[0-9]+');

Route::get($prefix . '/create', $router . '@create');

Route::get($prefix . '/update/{id}', $router . '@update')->where('id', '[0-9]+');

Route::get($prefix . '/delete/{id}', $router . '@delete')->where('id', '[0-9]+');