<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsOnProgramActivityPaymentsTable extends Migration
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
            $table->dropColumn('amount_requested');
            $table->dropColumn('total_items_amount_paid');
            $table->dropColumn('total_amount_paid');
            $table->dropColumn('total_participant_amount_paid');

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
