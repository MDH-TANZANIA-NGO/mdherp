<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_type');
            $table->string('maker');
            $table->string('model');
            $table->string('body_type');
            $table->integer('year');
            $table->string('color');
            $table->string('origin_country');
            $table->string('fuel_type');
            $table->integer('engine_size');
            $table->string('chasis_no');
            $table->string('vehicle_reg_no');
            $table->string('driver');
            $table->string('isactive');
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('fleets');
    }
}
