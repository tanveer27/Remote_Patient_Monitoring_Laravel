<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodPressureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloodpressures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->index();
            $table->integer('systolic');
            $table->integer('diastolic');
            $table->string('bp_data_status');
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
        Schema::drop('blood_pressures');
    }
}
