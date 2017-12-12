<?php

namespace OShop\Core\Shop\Order;

use Illuminate\Database\Eloquent\Model;
use OShop\Core\User\User;
use DB;
use OShop\Core\Thirdparty\SharePlateform\NotifyHandler;
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
        $order = null;
        try {
            DB::transaction(function () use ($input, &$order) {
                $order = Order::create([
                    // $input->TODO
                ]);
            });    
        } catch (\Exception $e) {
            return false;
        }

        static::notifyOuterPlateform($order->id);

        return $order->id;
    }

    protected static function notifyOuterPlateform($order_id)
    {
        NotifyHandler::notifyOrderComplete($order_id);
    }
}
