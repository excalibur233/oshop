<?php

namespace OShop\Core\Shop\Order;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

    protected $casts = [
        'fee_total' => 'float',
        'fee_delivery' => 'float',
        'fee_goods' => 'float',
        'fee_tax' => 'float',
        'fee_coupon_cut' => 'float',
        'commission' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
