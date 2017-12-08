<?php

namespace OShop\Http\Middleware;

use Closure;

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
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        

        return $next($request);
    }
}
