<?php

use Illuminate\Database\Seeder;
use OShop\Core\Shop\Commodity\Spu;
use OShop\Core\shop\Commodity\SpustatisticCategory;
use OShop\Core\User\User;


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
}
