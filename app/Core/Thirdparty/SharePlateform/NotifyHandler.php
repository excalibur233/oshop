<?php

namespace OShop\Core\Thirdparty\SharePlateform;

use OShop\Core\Shop\Order\Order;

class NotifyHandler
{
    public static function notifyOrderComplete($order_id)
    {
        $order = Order::find($order_id);
        $params = [];

        $params['productInfos'] = $order->lineItems;
        //TODO
    }
}