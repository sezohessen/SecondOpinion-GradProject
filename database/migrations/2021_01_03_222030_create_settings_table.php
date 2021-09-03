<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('appName');
            $table->string('appName_ar');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('whatsapp');
            $table->string('facebook');
            $table->string('instgram');
            $table->string('location');
            $table->string('andriod');
            $table->string('ios');
            $table->bigInteger('logo_id')->unsigned();
            $table->foreign('logo_id')
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
        Schema::dropIfExists('settings');
    }
}
