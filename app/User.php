<?php

namespace OShop;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OShop\Core\Wechat\Traits\WechatWebUser;

/**
 * OShop\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property-read \OShop\Core\Wechat\WechatWebProfile $wechatWebProfile
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use WechatWebUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
