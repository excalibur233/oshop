<?php

namespace OShop\Core\Shop\Commodity;

use Illuminate\Database\Eloquent\Model;
use OShop\Core\Shop\Order\Order;

/**
 * 订单中的商品，可视为下单时sku的快照
 *
 * Class LineItem
 * @package OShop
 */
class LineItem extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}