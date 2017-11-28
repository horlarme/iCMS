<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appsetting', function (Blueprint $table){
            $table->increments('id');
            $table->integer('setting_id')->unsigned();
            $table->string('name');
            $table->string('value');

            $table->foreign('setting_id')->references('id')->on('settinglist');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::drop('appsetting');
    }
}
