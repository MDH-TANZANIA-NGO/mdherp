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
            $table->smallInteger('requisition_id')->nullable();
            $table->smallInteger('is_done')->default(0);
            $table->smallInteger('status')->default(0);
            $table->unsignedInteger('district_id')->nullable();
            $table->bigInteger('report_id')->nullable();
            $table->bigInteger('total_participant')->nullable();
            $table->longText('camp')->nullable()->comment('place where the cov is conducting');
            $table->dateTime('checkin_time');
            $table->dateTime('checkout_time')->nullable();
            $table->double('checkin_latitude')->nullable();
            $table->double('checkin_longitude')->nullable();
            $table->string('checkin_location')->nullable();
            $table->double('checkout_latitude')->nullable();
            $table->double('checkout_longitude')->nullable();
            $table->string('checkout_location')->nullable();
            $table->uuid('uuid');
            $table->softDeletes();
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
