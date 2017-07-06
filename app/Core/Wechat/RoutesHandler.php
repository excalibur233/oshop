<?php


namespace OShop\Core\Wechat;


use Route;
use Socialite;

class RoutesHandler
{
    public static function routes()
    {
        Route::group(['prefix' => 'wechat-web'], function () {
            Route::get('/', 'Socialite\WechatWebController@authenticate');

            Route::get('/callback', 'Socialite\WechatWebController@callback');
        });
    }
}