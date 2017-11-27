<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('openid')->nullable()->unique();
            $table->string('unionid')->nullable()->unique();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->unsignedInteger('introducer_id')->nullable()->comments('推荐人id，绑定推荐关联关系');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('introducer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_introducer_id_foreign');
        });
        Schema::dropIfExists('users');
    }
}
