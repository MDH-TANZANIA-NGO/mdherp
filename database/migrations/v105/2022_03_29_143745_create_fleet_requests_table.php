<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_requests', function (Blueprint $table) {
                $table->id();
                $table->date('date');
                $table->string('program');
                $table->string('activity_description');
                $table->string('location');
                $table->time('starting_time');
                $table->time('ending_time');
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
        Schema::dropIfExists('fleet_requests');
    }
}
