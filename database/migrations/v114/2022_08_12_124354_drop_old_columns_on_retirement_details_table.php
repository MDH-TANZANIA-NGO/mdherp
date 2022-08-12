<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropOldColumnsOnRetirementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retirement_details', function (Blueprint $table) {
            $table->dropColumn('amount_requested');
            $table->dropColumn('amount_paid');
            $table->dropColumn('amount_received');
            $table->dropColumn('attachment_receipt');
            $table->dropColumn('attachment_supportive');
            $table->dropColumn('attachment_other');
            $table->dropColumn('amount_spent');
            $table->dropColumn('amount_variance');
            $table->dropColumn('planned_report');
            $table->dropColumn('no_participants');
            $table->dropColumn('objective_report');
            $table->dropColumn('methodology_report');
            $table->dropColumn('achievement_report');
            $table->dropColumn('challenge_report');
            $table->dropColumn('action_report');
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
