<?php

namespace OShop\Core\Shop\Commodity;

use Illuminate\Database\Eloquent\Model;

/**
 * 库存量单元
 * 
 * Class Sku (Stock Keeping Unit)
 *
 * @package OShop
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Sku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Sku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OShop\Sku whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sku extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function spu()
    {
        return $this->belongsTo(Spu::class);
    }

}
