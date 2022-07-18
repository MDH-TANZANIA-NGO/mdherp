<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverToIntervalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intervals', function (Blueprint $table) {
            $table->unsignedInteger('fleet_id_id')->nullable();
            $table->foreign('fleet_id_id', 'driver_fk_1028320')->references('id')->on('drivers');
            $table->unsignedInteger('user_id_id')->nullable();
            $table->foreign('user_id_id', 'driver_fk_1028321')->references('id')->on('drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intervals', function (Blueprint $table) {
            //
        });
    }
}
