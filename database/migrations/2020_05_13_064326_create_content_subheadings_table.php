<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentSubheadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_subheadings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('content')->nullable();
            $table->string('img')->nullable();
            $table->unsignedBigInteger('content_type_id');
            $table->foreign('content_type_id')
                ->references('id')
                ->on('content_types')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('subheading_id');
            $table->foreign('subheading_id')
                ->references('id')
                ->on('subheadings')
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
        Schema::dropIfExists('content_subheadings');
    }
}
