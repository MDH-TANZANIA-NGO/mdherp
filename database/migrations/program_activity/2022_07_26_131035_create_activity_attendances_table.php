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
            $table->bigInteger('offline_id');
            $table->bigInteger('g_scale_id')->nullable();
            $table->bigInteger('government_scale_id')->nullable();
            $table->bigInteger('designation_id')->nullable();
            $table->smallInteger('status')->default(1);
            $table->bigInteger('payment_id')->nullable();
            $table->boolean('paid')->default(false);
            $table->boolean('fraud')->default(false);
            $table->decimal('amount_requested', 15,2)->nullable();
            $table->decimal('amount_paid', 15,2)->nullable();
            $table->dateTime('checkin_time');
            $table->double('checkin_latitude')->nullable();
            $table->double('checkin_longitude')->nullable();
            $table->string('checkin_location')->nullable();
            $table->dateTime('checkout_time')->nullable();
            $table->double('checkout_latitude')->nullable();
            $table->double('checkout_longitude')->nullable();
            $table->string('checkout_location')->nullable();
            $table->string('mobile')->nullable();
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
        Schema::dropIfExists('activity_attendances');
    }
}
