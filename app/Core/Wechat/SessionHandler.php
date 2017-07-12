<?php


namespace OShop\Core\Wechat;


class SessionHandler
{
    /**
     * @param $wechat_user
     */
    public static function setAuthenticatedUser($wechat_user)
    {
        \Session::put('wechat_authenticated_user', $wechat_user);
    }

    /**
     * @return mixed
     */
    public static function getAuthenticatedUser()
    {
        return \Session::get('wechat_authenticated_user');
    }

    /**
     * @param string $route
     */
    public static function setNextRoute($route)
    {
        \Session::put('wechat_next_route', $route);
    }

    /**
     * @return string mixed
     */
    public static function getNextRoute()
    {
        return \Session::pull('wechat_next_route');
    }
}