<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnProgramActivityPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('program_activity_payments', function (Blueprint $table) {
            $table->decimal('amount_requested',15,2)->nullable();
            $table->decimal('total_items_amount_paid',15,2)->nullable();
            $table->decimal('total_participant_amount_paid',15,2)->nullable();
            $table->decimal('total_amount_paid',15,2)->nullable();

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
