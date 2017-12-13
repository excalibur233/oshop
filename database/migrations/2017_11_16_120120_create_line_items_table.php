<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('sku_id');
            $table->timestamp('sku_version')->comment('sku快照版本，按照加入时sku的updated_at决定。如果比对不一致，则认为sku是改动过的。');
            $table->decimal('price')->default(0.00)->comment('商品快照价格（下单时价格）');
            $table->decimal('commission')->default(0.00)->comment('商品快照返利价格（下单时返利价格）');
            $table->integer('amount')->default(1)->comment('商品购买数量');
            $table->boolean('on_sale')->default(0)->comment('是否是特价商品（下单时）');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('sku_id')->references('id')->on('skus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('line_items', function(Blueprint $table) {
            $table->dropForeign('line_items_order_id_foreign');
            $table->dropForeign('line_items_sku_id_foreign');
        });
        Schema::dropIfExists('line_items');
    }
}
