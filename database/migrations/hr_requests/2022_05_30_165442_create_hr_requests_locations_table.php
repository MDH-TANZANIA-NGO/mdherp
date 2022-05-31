<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrRequestsLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_requests_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_requests_id');
            $table->smallInteger('region_id');
            $table->unsignedBigInteger('number_of_employees');
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
        Schema::dropIfExists('hr_requests_locations');
    }
}
