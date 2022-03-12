<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')
            ->references('id')->on('doctors')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('center_id')->unsigned();
            $table->foreign('center_id')
            ->references('id')->on('centers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->boolean('doctor_seen')->default(0);
            $table->boolean('center_seen')->default(0);

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
        Schema::dropIfExists('contracts');
    }
}
