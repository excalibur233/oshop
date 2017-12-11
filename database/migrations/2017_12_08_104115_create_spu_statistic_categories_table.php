<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpuStatisticCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spu_statistic_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->timestamps();
        });

        Schema::table('spus', function (Blueprint $table) {
            $table->unsignedInteger('statistic_category_id')->nullable()->after('id');
            
            $table->foreign('statistic_category_id')->references('id')->on('spu_statistic_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spus', function (Blueprint $table) {
            $table->dropForeign('spus_statistic_category_id_foreign');

            $table->dropColumn('statistic_category_id');
        });

        Schema::dropIfExists('spu_statistic_categories');
    }
}
