<?php

use Faker\Generator as Faker;
use OShop\Product;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => '诺和针®32G',
        'description' => '诺和针®32G Tip ETW位一次性使用无菌注射针，与诺和诺德胰岛素注射系统配合使用。',
        'detail' => '<p><img src="http://o93nlp231.bkt.clouddn.com/uploads/ueditor/php/upload/image/20160621/1466490072863273.png" title="1466490072863273.png" alt="0.png"/><img src="http://o93nlp231.bkt.clouddn.com/uploads/ueditor/php/upload/image/20160621/1466490075792569.png" title="1466490075792569.png" alt="1.png"/><img src="http://o93nlp231.bkt.clouddn.com/uploads/ueditor/php/upload/image/20160621/1466490078984291.png" title="1466490078984291.png" alt="2.png"/><img src="http://o93nlp231.bkt.clouddn.com/uploads/ueditor/php/upload/image/20160621/1466490083205168.png" title="1466490083205168.png" alt="3.png"/><img src="http://o93nlp231.bkt.clouddn.com/uploads/ueditor/php/upload/image/20160621/1466490087537075.png" title="1466490087537075.png" alt="4.png"/><img src="http://o93nlp231.bkt.clouddn.com/uploads/ueditor/php/upload/image/20160621/1466490091971519.png" title="1466490091971519.png" alt="5.png"/><img src="http://o93nlp231.bkt.clouddn.com/uploads/ueditor/php/upload/image/20160621/1466490094523465.png" title="1466490094523465.png" alt="6.png"/><img src="http://o93nlp231.bkt.clouddn.com/uploads/ueditor/php/upload/image/20160621/1466490097750109.png" title="1466490097750109.png" alt="7.png"/></p>',
        'shown_price' => $faker->randomFloat(null, 1, 999),
        'image_thumbnail' => 'http://o93nlp231.bkt.clouddn.com/f78385376b0cd9f395467df04f049fb5.png',
        'image_slide' => '[http://o93nlp231.bkt.clouddn.com/f78385376b0cd9f395467df04f049fb5.png, http://o93nlp231.bkt.clouddn.com/f78385376b0cd9f395467df04f049fb5.png]',
    ];
});
