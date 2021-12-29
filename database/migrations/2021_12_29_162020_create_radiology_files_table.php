<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiologyFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiology_files', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('radiology_id')->unsigned();
            $table->foreign('radiology_id')
            ->references('id')->on('radiologies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('image_id')->unsigned();
            $table->foreign('image_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('radiology_files');
    }
}
