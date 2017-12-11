<?php

use Illuminate\Database\Seeder;
use OShop\Core\Shop\Commodity\Spu;
use OShop\Core\Shop\Commodity\SpuStatisticCategory;
use OShop\Core\User\User;
use OShop\Core\Shop\Commodity\Sku;
use function bar\baz\foo;


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
            'storage' => 10000
        ]);
    }

    protected function createSecondSkuForSpu($spu_id)
    {
        Sku::create([
            'spu_id' => $spu_id,
            'label' => '第二个规格',
            'description' => '第二个品类',
            'storage' => 20000
        ]);
    }
}
