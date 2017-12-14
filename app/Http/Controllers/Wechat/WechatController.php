<?php

namespace OShop\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use Log;
use OShop\Http\Controllers\Controller;

class WechatController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function($message) {
            return "欢迎关注 易康伴侣！";
        });
        
        return $app->server->serve();
    }

    public function config(Request $request)
    {
        $jssdk = app('wechat.official_account')->jssdk;
        if ($request->has('url')) {
            $jssdk->setUrl($request->input('url'));
        }

        return $jssdk->buildConfig(array('openAddress'), true, true, true);
    }
}
