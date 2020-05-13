<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentSubheadingManiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_subheading_manies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('content')->nullable();
            $table->string('img')->nullable();
            $table->enum('content_type', ['text', 'img']);
            $table->unsignedBigInteger('subheading_many_id');
            $table->foreign('subheading_many_id')
                ->references('id')
                ->on('subheading_manies')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('present_id');
            $table->foreign('present_id')
                ->references('id')
                ->on('presents')
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
        Schema::dropIfExists('content_subheading_manies');
    }
}
