<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubheadingManiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subheading_manies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('color', 30)->index()->default('#FFFFFF');
            $table->unsignedBigInteger('subheading_id');
            $table->unsignedBigInteger('present_id');
            $table->unsignedBigInteger('main_slide_id');
            $table->string('text_header');
            $table->string('section_id')->unique();
            $table->string('background', 30)->index();
//            $table->foreign('color')
//                ->references('code')
//                ->on('colors')
//                ->onUpdate('CASCADE')->onDelete('CASCADE');
//            $table->foreign('background')
//                ->references('code')
//                ->on('colors')
//                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('present_id')
                ->references('id')
                ->on('presents')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('main_slide_id')
                ->references('id')
                ->on('main_slides')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('subheading_id')
                ->references('id')
                ->on('subheadings')
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
        Schema::dropIfExists('subheading_manies');
    }
}
