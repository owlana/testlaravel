<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->integer('price')->unsigned();
        });

        Schema::table('doctor_service', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('doctor_service', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services')
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
        Schema::table('doctor_service', function (Blueprint $table) {
            $table->dropForeign('doctor_service_doctor_id_foreign');
        });

        Schema::table('doctor_service', function (Blueprint $table) {
            $table->dropForeign('doctor_service_service_id_foreign');
        });

        Schema::dropIfExists('doctor_service');
    }
}
