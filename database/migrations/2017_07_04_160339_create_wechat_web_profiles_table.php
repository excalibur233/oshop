<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatWebProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_web_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->unique();
            $table->string('openid');
            $table->string('nickname')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('language')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('headimgurl')->nullable();
            $table->string('unionid')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wechat_web_profiles', function(Blueprint $table) {
            $table->dropForeign('wechat_web_profiles_user_id_foreign');
        });
        Schema::dropIfExists('wechat_web_profiles');
    }
}
