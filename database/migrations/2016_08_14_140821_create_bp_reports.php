<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_pressure_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bp_id')->index()->unsigned();
            $table->foreign('bp_id')->references('id')->on('bloodpressures')->onDelete('cascade');
            $table->integer('doctor_id')->index()->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('prescription')->nullable();
            $table->string('bp_report');
            $table->string('bp_report_status');
            $table->unique(['doctor_id', 'bp_id']);
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
        Schema::drop('blood_pressure_reports');
    }
}
