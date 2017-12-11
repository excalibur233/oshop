<?php

/*
 * 认证路由
 */
//Auth::loginUsingId(1);
//Auth::routes();

/*
 * 微信公众号相关路由
 */
Route::any('/wechat', 'Wechat/WeChatController@serve');


Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/user', function () {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($user);
    });

    /*
     * 前端路由，交由vue-router，注意放在最后！
    */
    Route::any('/{any?}', 'HomeController@index')->name('home')->where('any','.*');
});