<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotspotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotspots', function (Blueprint $table) {
            $table->id();
            $table->morphs('creator');
            $table->longText('location')->nullable();
            $table->smallInteger('isdone')->default(0);
            $table->unsignedInteger('district_id')->nullable();
            $table->bigInteger('report_id')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->bigInteger('total_participant');
            $table->longText('camp')->nullable()->comment('place where the cov is conducting');
            $table->dateTime('checkin_time');
            $table->dateTime('checkout_time')->nullable();
            $table->uuid('uuid');
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
        Schema::dropIfExists('hotspots');
    }
}
