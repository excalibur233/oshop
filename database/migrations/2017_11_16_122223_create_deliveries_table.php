<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('type')->nullable()->comments('快递类型，如圆通、顺丰、EMS');
            $table->string('number')->nullable()->comments('快递编号');
            $table->string('name')->comments('手机号');
            $table->string('phone')->comments('手机号');
            $table->string('province')->comments('省');
            $table->string('city')->comments('市');
            $table->string('country')->comments('区');
            $table->string('address_detail')->comments('详细地址');
            $table->string('postal_code')->comments('邮政编码');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliveries', function(Blueprint $table) {
            $table->dropForeign('deliveries_order_id_foreign');
        });
        Schema::dropIfExists('deliveries');
    }
}
