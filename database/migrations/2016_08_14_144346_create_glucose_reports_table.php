<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlucoseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glucose_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('glucose_id')->index()->unsigned();
            $table->foreign('glucose_id')->references('id')->on('glucoses')->onDelete('cascade');
            $table->integer('doctor_id')->index()->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('glucose_report');
            $table->string('glucose_report_status');
            $table->string('prescription')->nullable();
            $table->unique(['doctor_id', 'glucose_id']);
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
        Schema::drop('glucose_reports');
    }
}
