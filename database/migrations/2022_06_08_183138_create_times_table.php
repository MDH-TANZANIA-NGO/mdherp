<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('time_start');
            $table->string('lat_in');
            $table->string('long_in');
            $table->datetime('time_end')->nullable();
            $table->string('lat_out')->nullable();
            $table->string('long_out')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_1028320')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
}
