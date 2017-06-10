<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_patient', function (Blueprint $table) {
            $table->integer('view_id')->index()->unsigned();
            $table->foreign('view_id')->references('id')->on('patients')->onDelete('cascade');
            $table->integer('viewer_id')->index()->unsigned();
            $table->foreign('viewer_id')->references('id')->on('patients')->onDelete('cascade');
            $table->primary(['view_id', 'viewer_id']);
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
        Schema::drop('patient_patient');
    }
}
