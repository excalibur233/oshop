<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use OShop\Core\Wechat\RoutesHandler;

Route::get('/', function () {
    dd(Auth::user()->wechatWebProfile);
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
RoutesHandler::routes();