<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSpecialityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_speciality', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('speciality_id')->unsigned();
        });

        Schema::table('doctor_speciality', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('doctor_speciality', function (Blueprint $table) {
            $table->foreign('speciality_id')->references('id')->on('specialities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_speciality', function (Blueprint $table) {
            $table->dropForeign('doctor_speciality_doctor_id_foreign');
            $table->dropForeign('doctor_speciality_speciality_id_foreign');
        });

        Schema::dropIfExists('doctor_speciality');
    }
}
