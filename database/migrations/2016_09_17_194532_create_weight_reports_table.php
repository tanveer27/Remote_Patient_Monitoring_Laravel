<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weight_id')->index()->unsigned();
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade');
            $table->integer('doctor_id')->index()->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('weight_report');
            $table->string('weight_report_status');
            $table->string('prescription')->nullable();
            $table->unique(['doctor_id', 'weight_id']);
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
        Schema::drop('weight_reports');
    }
}
