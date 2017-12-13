<?php

namespace OShop\Core\Shop\Order;

use Illuminate\Database\Eloquent\Model;
use OShop\Core\User\User;
use DB;
use OShop\Core\Thirdparty\SharePlateform\NotifyHandler;
use Carbon\Carbon;
use OShop\Core\Shop\Commodity\LineItem;
use OShop\Core\Shop\Commodity\Sku;
use OShop\Core\Shop\Order\Bill;
use OShop\Core\Shop\Order\Delivery;
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

                /**
                 * @var $user 当前存储的用户。这里使用了有状态的session，后期应该替换成无状态的，通过request中的token来获取当前user.
                 */
                $user = User::where('openid', session('wechat.oauth_user')->id)->firstOrFail();
                // $user = User::first();

                $order = new Order();
                $order->user_id = $user->id;
                $order->serial = 'OS'. Carbon::now()->format('YmdHis'). random_int(1, 1000);
                $order->remark = array_get($input, 'remark');
                $order->save();

                
                $list = $input['goodsList'];
                $fee_goods = 0.00;
                $commission_total = 0.00;
                foreach ($list as $item) {
                    $sku = Sku::findOrFail($item['sku_id']);

                    $line_item = new LineItem();
                    $line_item->order_id = $order->id;
                    $line_item->sku_id = $item['sku_id'];
                    $line_item->sku_version = $sku->updated_at;
                    $line_item->price = ($price = $sku->price);
                    $line_item->commission = ($commission = $sku->commission);
                    $line_item->amount = ($amount = $item['buy_num']);
                    $line_item->save();
                
                    $fee_goods += $price * $amount;
                    $commission_total += $commission;
                }

                $bill = new Bill();
                $bill->order_id = $order->id;
                $bill->payment_type = 'wechat';
                $bill->payment_completed = 1;
                $bill->trade_no = 'test'.time();
                $bill->fee_total = $fee_goods + 8.00;
                $bill->fee_delivery = 8.00;
                $bill->fee_goods = $fee_goods;
                $bill->commission = $commission_total;
                $bill->save();

                $delivery = new Delivery();
                $delivery->order_id = $order->id;
                $delivery->name = $input['address']['userName'];
                $delivery->phone = $input['address']['telNumber'];
                $delivery->country = $input['address']['nationalCode'];
                $delivery->province = $input['address']['provinceName'];
                $delivery->city = $input['address']['cityName'];
                $delivery->district = $input['address']['countryName'];
                $delivery->address_detail = $input['address']['detailInfo'];
                $delivery->postal_code = $input['address']['postalCode'];
                $delivery->save();
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
