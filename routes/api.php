<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*
 * 认证逻辑
 */
Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
    Route::post('login', 'JWTAuthController@login');
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::post('me', 'JWTAuthController@me');
});


Route::group([
    // 'middleware' => 'auth:api'
], function(){
    /*
     * 商城逻辑
     */
    Route::resource('spu', 'SpuController');
    Route::resource('order', 'OrderController');

    Route::get('wechat/config', 'Wechat/WechatController@config');
});
