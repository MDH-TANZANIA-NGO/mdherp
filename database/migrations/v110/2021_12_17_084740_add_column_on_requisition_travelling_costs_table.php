<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOnRequisitionTravellingCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('requisition_travelling_costs', function (Blueprint $table) {
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->decimal('perdiem_rate',15,2)->nullable();
            $table->decimal('ontransit',15,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
