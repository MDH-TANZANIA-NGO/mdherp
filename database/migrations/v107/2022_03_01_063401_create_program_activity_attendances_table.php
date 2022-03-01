<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramActivityAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_activity_attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('program_activity_id');
            $table->dateTime('checkin_time')->nullable();
            $table->double('checkin_latitude')->nullable();
            $table->double('checkin_longitude')->nullable();
            $table->string('checkin_location')->nullable();
            $table->dateTime('checkout_time')->nullable();
            $table->double('checkout_latitude')->nullable();
            $table->double('checkout_longitude')->nullable();
            $table->string('checkout_location')->nullable();
            $table->date('date')->nullable();
            $table->text('uuid');
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('program_activity_attendances');
    }
}
