<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->text('desc')->nullable();;
            $table->text('desc_ar')->nullable();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('cover_id')->unsigned()->nullable();
            $table->foreign('cover_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('governorate_id')->unsigned()->nullable();
            $table->foreign('governorate_id')
            ->references('id')->on('governorates')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')
            ->references('id')->on('cities')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('street')->nullable();
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
        Schema::dropIfExists('centers');
    }
}
