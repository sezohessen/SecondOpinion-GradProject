<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            $table->string('national_id')->unique()->nullable();
            $table->string('facebook')->nullable();
            $table->text('brief_desc');
            $table->text('brief_desc_ar');
            $table->boolean('active')->default(1);

            $table->bigInteger('field_id')->unsigned()->nullable();
            $table->foreign('field_id')
            ->references('id')->on('fields')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('avatar_id')->unsigned()->nullable();
            $table->foreign('avatar_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('governorate_id')->unsigned();
            $table->foreign('governorate_id')
            ->references('id')->on('governorates')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('city_id')->unsigned();
            $table->foreign('city_id')
            ->references('id')->on('cities')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::dropIfExists('doctors');
    }
}
