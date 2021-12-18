<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSpecializesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_specializes', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')
            ->references('id')->on('doctors')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('specialize_id')->unsigned();
            $table->foreign('specialize_id')
            ->references('id')->on('specialties')
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
        Schema::dropIfExists('doctor_specializes');
    }
}
