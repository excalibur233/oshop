<?php

namespace OShop;

use Illuminate\Database\Eloquent\Model;

/**
 * 订单，在下单时生成
 *
 * Class Order
 * @package OShop
 */
class Order extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
}
