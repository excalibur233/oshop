<?php

namespace OShop\Core\Shop\Order;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
