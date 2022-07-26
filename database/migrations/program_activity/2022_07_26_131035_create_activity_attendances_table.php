<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('hotspot_id');
            $table->morphs('creator');
//            $table->multiPolygon('geometry')->nullable();
            $table->bigInteger('offline_id');
            $table->smallInteger('status')->default(1);
            $table->decimal('amount_requested', 15,2)->nullable();
            $table->decimal('amount_paid', 15,2)->nullable();
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
        Schema::dropIfExists('activity_attendances');
    }
}
