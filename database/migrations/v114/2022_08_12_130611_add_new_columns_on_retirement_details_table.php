<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsOnRetirementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retirement_details', function (Blueprint $table) {
            $table->decimal('accomodation', 15, 2)->nullable();
            $table->decimal('perdiem_total_amount', 15, 2)->nullable();
            $table->decimal('ticket_fair', 15, 2)->nullable();
            $table->decimal('ontransit', 15, 2)->nullable();
            $table->decimal('transportation', 15, 2)->nullable();
            $table->decimal('other_cost', 15, 2)->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->decimal('total_amount_paid', 15, 2)->nullable();
            $table->decimal('balance', 15, 2)->nullable();
           // $table->text('activity_report')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retirement_details', function (Blueprint $table) {
            //
        });
    }
}
