<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravellingAdvanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travelling_advance_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travelling_advance_id');
            $table->date('from');
            $table->date('to');
            $table->unsignedBigInteger('district_id');
            $table->decimal('perdiem', 15, 2)->nullable();
            $table->decimal('ontransit', 15, 2)->nullable();
            $table->decimal('transportation', 15, 2)->nullable();
            $table->decimal('other_costs', 15, 2)->nullable();
            $table->date('deleted_at');
            $table->string('uuid');
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
        Schema::dropIfExists('travelling_advance_details');
    }
}
