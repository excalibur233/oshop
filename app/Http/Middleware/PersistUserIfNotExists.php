<?php

namespace OShop\Http\Middleware;

use Closure;
use OShop\Core\User\User;
use OShop\Core\User\WechatProfile;

class PersistUserIfNotExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $wechat_user = session('wechat.oauth_user'); // 拿到授权用户资料

        if (($user = User::where('openid', $wechat_user->id)->first()) == null) {
            $original = $wechat_user->getOriginal();

            \DB::transaction(function () use ($original) {
                $user = new User();
                $user->openid = array_get($original, 'openid');
                $user->unionid = array_get($original, 'unionid');
                $user->save();

                $wechat_profile = new WechatProfile();
                $wechat_profile->user_id = $user->id;
                $wechat_profile->openid = array_get($original, 'openid');
                $wechat_profile->unionid = array_get($original, 'unionid');
                $wechat_profile->nickname = array_get($original, 'nickname');
                $wechat_profile->sex = array_get($original, 'sex');
                $wechat_profile->language = array_get($original, 'language');
                $wechat_profile->city = array_get($original, 'city');
                $wechat_profile->province = array_get($original, 'province');
                $wechat_profile->country = array_get($original, 'country');
                $wechat_profile->headimgurl = array_get($original, 'headimgurl');
                $wechat_profile->save();
            });  
        }

        return $next($request);
    }
}
