<?php

use OShop\Core\Wechat\RoutesHandler;
use OShop\Http\Resources\Spu as SpuResource;
use OShop\Http\Resources\SpuCollection;
use OShop\Spu;

Auth::loginUsingId(1);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
RoutesHandler::routes();

Route::resource('spu', 'SpuController');

Route::any('/{any?}', 'HomeController@index')->name('home')->where('any','.*');
