<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->longText('content');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('views')->default(o);
            $table->string('tags');
            $table->string('url')->unique();
            $table->integer('type')->default(0)->comment('0 - Draft, 1 - Scheduled, 2 - Published, 3 - Deleted');
            $table->datetime('schedule')->nullable();
            $table->datetime('created');
            $table->datetime('deleted')->nullable();
            // $table->timestamps()

            //Setting the foreign key
            //Links to the user
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            //Link to the category
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::drop('categories');
    }
}
