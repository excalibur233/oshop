<?php

namespace OShop\Http\Controllers\Socialite;

use Illuminate\Http\Request;
use OShop\Http\Controllers\Controller;
use Socialite;

class WechatWebController extends Controller
{
    public function authenticate()
    {
        return Socialite::with('weixinweb')->redirect();
    }

    public function callback()
    {
        $socialite = Socialite::driver('weixinweb')->user();

        /** @var \OShop\User $authenticated */
        if ($authenticated = \Auth::user()) {
            $authenticated->updateWechatWebProfile($socialite);
            return redirect('/home');
        } else {
            dd($socialite);
        }
    }
}
