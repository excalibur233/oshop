<?php

namespace OShop\Http\Middleware;

use Closure;
use OShop\Core\User\User;

class UpdateIntroducerIfProvided
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
        if ($request->has('shareId')) {
            $wechat_user = session('wechat.oauth_user');

            $user = User::where('openid', $wechat_user->id)->firstOrFail();
            $user->introducer_unionid = $request->input('shareId');
            $user->save();
        }

        return $next($request);
    }
}
