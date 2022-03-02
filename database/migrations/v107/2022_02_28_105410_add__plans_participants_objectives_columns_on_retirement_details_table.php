<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlansParticipantsObjectivesColumnsOnRetirementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retirement_details', function (Blueprint $table) {
            $table->longText('planned_report')->nullable();
            $table->text('no_participants')->nullable();
            $table->longText('objective_report')->nullable();
            $table->longText('methodology_report')->nullable();
            $table->longText('achievement_report')->nullable();
            $table->longText('challenge_report')->nullable();
            $table->longText('action_report')->nullable();
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
