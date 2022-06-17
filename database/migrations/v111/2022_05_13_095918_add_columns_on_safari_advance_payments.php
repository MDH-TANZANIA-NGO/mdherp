<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnSafariAdvancePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('safari_advance_payments', function (Blueprint $table) {
            $table->decimal('perdiem_total_amount', 15, 2)->nullable();
            $table->decimal('transportation', 15, 2)->nullable();
            $table->decimal('requisition_travelling_cost_id', 15, 2)->nullable();
            $table->decimal('accommodation', 15, 2)->nullable();
            $table->decimal('ontransit', 15, 2)->nullable();
            $table->decimal('other_cost', 15, 2)->nullable();
            $table->decimal('ticket_fair', 15, 2)->nullable();

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
