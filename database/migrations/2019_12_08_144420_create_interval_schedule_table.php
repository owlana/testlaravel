<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervalScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interval_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('schedule_id')->unsigned();
            $table->bigInteger('interval_id')->unsigned();
            $table->boolean('is_busy')->default(false);
        });

        Schema::table('interval_schedule', function (Blueprint $table) {
            $table->foreign('schedule_id')->references('id')->on('schedules')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('interval_id')->references('id')->on('intervals')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique(['schedule_id', 'interval_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interval_schedule', function (Blueprint $table) {
            $table->dropForeign('interval_schedule_schedule_id_foreign');
            $table->dropForeign('interval_schedule_interval_id_foreign');
            $table->dropUnique('interval_schedule_schedule_id_interval_id_unique');
        });

        Schema::dropIfExists('appointments');
    }
}
