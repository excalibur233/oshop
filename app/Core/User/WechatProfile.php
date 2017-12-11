<?php

namespace OShop\Core\User;

use Illuminate\Database\Eloquent\Model;

class WechatProfile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
