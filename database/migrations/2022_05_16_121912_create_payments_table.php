<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')
            ->references('id')->on('doctors')
            ->onDelete('set null');

            $table->bigInteger('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade')
            ->onDelete('set null');

            $table->bigInteger('center_id')->unsigned()->nullable();
            $table->foreign('center_id')
            ->references('id')->on('centers')
            ->onDelete('set null');

            $table->integer('price');
            $table->integer('status');
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
        Schema::dropIfExists('payments');
    }
}
