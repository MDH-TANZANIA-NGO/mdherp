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
                $table->text('uuid')->nullable();
                $table->integer('wf_done')->default(0)->nullable();
                $table->dateTime('wf_done_date')->nullable();
                $table->boolean('rejected')->default(false)->nullable();
                $table->bigInteger('user_id')->nullable();
                $table->bigInteger('done')->default(0)->nullable();
                $table->date('deleted_at')->nullable();
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
