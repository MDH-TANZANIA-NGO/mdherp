<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnRequisitionTravellingCostDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('requisition_travelling_cost_districts', function (Blueprint $table) {
            $table->bigInteger('mdh_rate_id')->nullable();
            $table->date('from');
            $table->date('to');
            $table->bigInteger('no_days');
            $table->decimal('perdiem_total_amount',15,2)->nullable();
            $table->decimal('transportation',15,2)->nullable();
            $table->decimal('accommodation',15,2)->nullable();
            $table->decimal('total_accommodation',15,2)->nullable();
            $table->decimal('other_cost',15,2)->nullable();
            $table->text('other_cost_description')->nullable();
            $table->decimal('total_amount','15','2');
            $table->timestamp('deleted_at')->nullable();

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
