<?php

namespace OShop\Core\Wechat;

use Illuminate\Database\Eloquent\Model;
use OShop\User;

/**
 * OShop\Core\Wechat\WechatProfile
 *
 * @property-read \OShop\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $user_id
 * @property string $openid
 * @property string|null $nickname
 * @property int|null $sex
 * @property string|null $language
 * @property string|null $city
 * @property string|null $province
 * @property string|null $country
 * @property string|null $headimgurl
 * @property string|null $unionid
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereHeadimgurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereUnionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Core\Wechat\WechatWebProfile whereUserId($value)
 */
class WechatWebProfile extends Model
{
    protected $fillable = [
        'openid', 'user_id', 'nickname', 'sex', 'language', 'city', 'province', 'country', 'headimgurl', 'unionid'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
