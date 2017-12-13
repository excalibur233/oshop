<?php

use Illuminate\Database\Seeder;
use OShop\Core\Shop\Commodity\Spu;
use OShop\Core\Shop\Commodity\SpuStatisticCategory;
use OShop\Core\User\User;
use OShop\Core\Shop\Commodity\Sku;
use OShop\Core\Shop\Order\Order;
use Carbon\Carbon;
use OShop\Core\Shop\Commodity\LineItem;
use OShop\Core\Shop\Order\Bill;
use OShop\Core\Shop\Order\Delivery;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSpuStatisticCategories();

        factory(User::class, 30)->create();
        factory(Spu::class, 200)->create();

        $this->createSkus();
        $this->createAnOrder();
    }

    protected function createSpuStatisticCategory($name, $label) 
    {
        SpuStatisticCategory::create([
            'name' => $name,
            'label' => $label
        ]);

        return $this;
    }

    protected function createSpuStatisticCategories()
    {
        $this->createSpuStatisticCategory('母婴奶粉', '母婴奶粉');
        $this->createSpuStatisticCategory('试纸', '试纸');
        $this->createSpuStatisticCategory('糖尿病', '糖尿病');
    }

    protected function createSkus()
    {
        for ($i=1; $i < 31; $i++) { 
            $this->createDefaultSkuForSpu($i);
            $this->createSecondSkuForSpu($i);
        }
    }

    protected function createDefaultSkuForSpu($spu_id)
    {
        Sku::create([
            'spu_id' => $spu_id,
            'label' => '默认',
            'description' => '默认品类',
            'image_thumbnail' => 'http://o93nlp231.bkt.clouddn.com/f78385376b0cd9f395467df04f049fb5.png',
            'price' => ($price = random_int(1, 1000)),
            'commission' => array_random([0.1, 0.2, 0.3]) * $price,
            'storage' => random_int(1, 10000)
        ]);
    }

    protected function createSecondSkuForSpu($spu_id)
    {
        Sku::create([
            'spu_id' => $spu_id,
            'label' => '第二个规格',
            'description' => '第二个品类',
            'image_thumbnail' => 'http://o93nlp231.bkt.clouddn.com/f78385376b0cd9f395467df04f049fb5.png',
            'price' => ($price = random_int(1, 1000)),
            'commission' => array_random([0.1, 0.2, 0.3]) * $price,
            'storage' => random_int(1, 10000)
        ]);
    }

    protected function createAnOrder()
    {
        DB::transaction(function () {
            $order = Order::create([
                'user_id' => 1,
                'serial' => 'OS'. Carbon::now()->format('YmdHis'). random_int(1, 1000),
                'remark' => '不要送货！'
            ]);

            $fee_goods = 0.00;
            
            $max = random_int(1, 11);
            for ($i = 1; $i < $max; $i++) { 
                $sku = Sku::find($i);
                $line_item = LineItem::create([
                    'order_id' => $order->id,
                    'sku_id' => $sku->id,
                    'sku_version' => $sku->updated_at,
                    'price' => ($price = $sku->price),
                    'amount' => ($amount = random_int(1, 2)),
                    'on_sale' => 0
                ]);

                $fee_goods += $price * $amount;
            }

            $bill = Bill::create([
                'order_id' => $order->id,
                'payment_type' => 'wechat',
                'payment_completed' => 1,
                'trade_no' => time(),
                'fee_total' => $fee_goods + 8.00,
                'fee_delivery' => 8.00,
                'fee_goods' => $fee_goods,
            ]);

            $delivery = Delivery::create([
                'order_id' => $order->id,
                'name' => '张三',
                'phone' => '18888888888',
                'country' => '中国',
                'province' => '湖北',
                'city' => '武汉',
                'district' => '洪山',
                'address_detail' => '洪山区光谷生物城c2-4 迈德科技',
                'postal_code' => '430000'
            ]);
        });
    }
}
