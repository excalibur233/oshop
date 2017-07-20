<?php

use Illuminate\Database\Seeder;
use OShop\Product;
use OShop\User;

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
        factory(Product::class, 200)->create();
    }
}
