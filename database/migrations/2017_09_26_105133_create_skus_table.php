<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('spu_id');
            $table->string('label')->comments('sku显示名称');
            $table->string('description')->comments('sku描述');
            $table->integer('storage')->default(0)->comments('sku库存');
            $table->timestamps();

            $table->foreign('spu_id')->references('id')->on('spus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skus', function(Blueprint $table) {
            $table->dropForeign('skus_spu_id_foreign');
        });
        Schema::dropIfExists('skus');
    }
}
