<?php

use Illuminate\Database\Seeder;
use OShop\Core\Shop\Commodity\Spu;
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
        factory(User::class, 30)->create();
        factory(Spu::class, 200)->create();
    }
}
