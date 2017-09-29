<?php

use Illuminate\Database\Seeder;
use OShop\Spu;
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
        factory(Spu::class, 200)->create();
    }
}
