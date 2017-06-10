<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemperatureReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temperature_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('temperature_id')->index()->unsigned();
            $table->foreign('temperature_id')->references('id')->on('temperatures')->onDelete('cascade');
            $table->integer('doctor_id')->index()->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('temp_report');
            $table->string('temp_report_status');
            $table->string('prescription')->nullable();
            $table->unique(['doctor_id', 'temperature_id']);
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
        Schema::drop('temperature_reports');
    }
}
