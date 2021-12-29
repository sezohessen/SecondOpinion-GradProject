<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiologies', function (Blueprint $table) {
            $table->id();
            $table->text("desc");

            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')
            ->references('id')->on('doctors')
            ->onDelete('set null');

            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('center_id')->unsigned()->nullable();
            $table->foreign('center_id')
            ->references('id')->on('centers')
            ->onDelete('set null');

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
        Schema::dropIfExists('radiologies');
    }
}
