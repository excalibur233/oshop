<?php

namespace OShop;

use Illuminate\Database\Eloquent\Model;

/**
 * 标准产品单元
 * 
 * Class Spu (Standard Product Unit)
 *
 * @package OShop
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $detail
 * @property float $shown_price
 * @property string $image_thumbnail
 * @property mixed $image_slide
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereImageSlide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereImageThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereShownPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Spu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Spu extends Model
{
    protected $casts = [
        'image_slide' => 'array'
    ];
}
