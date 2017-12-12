<?php

namespace OShop\Core\Shop\Order;

use Illuminate\Database\Eloquent\Model;
use OShop\Core\User\User;
use DB;

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

    public static function createWithAttributes($input)
    {
        DB::transaction(function () use ($input) {
            $order = Order::create([
                // $input->TODO
            ]);
        });

        return $order->id;
    }
}
