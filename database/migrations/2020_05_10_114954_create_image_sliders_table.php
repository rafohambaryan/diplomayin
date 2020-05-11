<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('present_id');
            $table->unsignedBigInteger('main_slider_id');
            $table->string('background', 30)->index();
            $table->foreign('background')
                ->references('code')
                ->on('colors')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('main_slider_id')
                ->references('id')
                ->on('main_slides')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('present_id')
                ->references('id')
                ->on('presents')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('text_header');
            $table->string('img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_sliders');
    }
}
