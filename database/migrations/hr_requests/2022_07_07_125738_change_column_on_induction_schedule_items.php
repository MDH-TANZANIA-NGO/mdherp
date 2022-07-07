<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnOnInductionScheduleItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('induction_schedule_items', function (Blueprint $table) {
            $table->renameColumn('completed', 'completed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('induction_schedule_items', function (Blueprint $table) {
            $table->renameColumn('completed_at', 'completed');
        });
    }
}
