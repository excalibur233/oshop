<?php

namespace OShop;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Delivery
 * @package OShop
 */
class Delivery extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
