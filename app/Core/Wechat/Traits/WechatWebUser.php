<?php


namespace OShop\Core\Wechat\Traits;


use OShop\Core\Wechat\WechatWebProfile;

trait WechatWebUser
{
    public function updateWechatWebProfile($socialite)
    {
        WechatWebProfile::updateOrCreate(['user_id' => $this->id], $socialite->user);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wechatWebProfile()
    {
        return $this->hasOne(WechatWebProfile::class);
    }
}