<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('payment_type')->comment('支付方式，如微信，支付宝');
            $table->boolean('payment_completed')->default(0)->comment('支付完成');
            $table->string('trade_no')->comment('交易编号，对应微信支付out_trade_no');
            $table->unsignedInteger('coupon_id')->nullable()->comment('优惠券id，一个订单只能用一张优惠券');
            $table->decimal('fee_total')->default(0.00)->comment('总价格');
            $table->decimal('fee_delivery')->default(0.00)->comment('运费');
            $table->decimal('fee_goods')->default(0.00)->comment('商品总价，order中所有line item价格总和');
            $table->decimal('fee_tax')->default(0.00)->comment('税费，海淘所需');
            $table->decimal('fee_coupon_cut')->default(0.00)->comment('优惠券减扣价格，应为负数');
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
        Schema::table('bills', function(Blueprint $table) {
            $table->dropForeign('bills_order_id_foreign');
        });
        Schema::dropIfExists('bills');
    }
}
