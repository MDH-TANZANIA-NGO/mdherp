<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('checkin_time')->nullable();
            $table->double('checkin_latitude')->nullable();
            $table->double('checkin_longitude')->nullable();
            $table->string('checkin_location')->nullable();
            $table->dateTime('checkout_time')->nullable();
            $table->double('checkout_latitude')->nullable();
            $table->double('checkout_longitude')->nullable();
            $table->string('checkout_location')->nullable();
            $table->uuid('uuid');
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
        Schema::dropIfExists('attendances');
    }
}
