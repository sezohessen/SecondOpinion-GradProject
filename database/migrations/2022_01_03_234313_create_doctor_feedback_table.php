<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_feedback', function (Blueprint $table) {
            $table->id();
            $table->string("desc");

            $table->bigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')
            ->references('id')->on('doctors')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('radiology_id')->unsigned();
            $table->foreign('radiology_id')
            ->references('id')->on('radiologies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string("pdf_report")->nullable();

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
        Schema::dropIfExists('doctor_feedback');
    }
}
