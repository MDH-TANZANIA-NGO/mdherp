<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('license_no')->nullable();
            $table->string('class_type_of_license')->nullable();
            $table->string('license_expiry_date')->nullable();
            $table->unsignedInteger('fleet_id')->nullable();
            $table->foreign('fleet_id', 'fleet_fk_1028320')->references('id')->on('fleets');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1028320')->references('id')->on('users');
            $table->rememberToken();
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
        Schema::dropIfExists('drivers');
    }
}
