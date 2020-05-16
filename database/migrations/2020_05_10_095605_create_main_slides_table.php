<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_slides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('present_id');
            $table->string('color', 30)->index()->default('#FFFFFF');
            $table->foreign('color')
                ->references('code')
                ->on('colors')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('present_id')
                ->references('id')
                ->on('presents')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('logo');
            $table->string('logo_url');
            $table->string('present_logo');
            $table->string('main_name');
            $table->string('topic');
            $table->string('student');
            $table->string('head');
            $table->string('background',30)->index();
            $table->foreign('background')
                ->references('code')
                ->on('colors')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('main_slides');
    }
}
