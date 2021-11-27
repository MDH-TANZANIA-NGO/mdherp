<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionTravellingCostssTable extends Migration
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
            $table->bigInteger('traveller_uid');
            $table->bigInteger('perdiem_rate_id');
            $table->bigInteger('no_days');
            $table->bigInteger('district_id');
            $table->decimal('perdiem_total_amount',15,2)->nullable();
            $table->decimal('transportation',15,2)->nullable();
            $table->decimal('accommodation',15,2)->nullable();
            $table->decimal('other_cost',15,2)->nullable();
            $table->decimal('total_amount','15','2');
            $table->timestamp('deleted_at')->nullable();
            $table->text('description');
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
        Schema::dropIfExists('requisition_travelling_costss');
    }
}
