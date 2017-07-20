<?php

use OShop\Core\Wechat\RoutesHandler;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
RoutesHandler::routes();

Route::get('products', 'ProductController@index');
