<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravellingCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_travelling_costs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('requisition_id');
            $table->bigInteger('user_id');
            $table->smallInteger('no_days');
            $table->bigInteger('mdh_rate_id');
            $table->decimal('total_perdiem_amount');
            $table->bigInteger('accommodation');
            $table->bigInteger('transportation');
            $table->bigInteger('other_cost');
            $table->bigInteger('total_amount');
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

    }
}
