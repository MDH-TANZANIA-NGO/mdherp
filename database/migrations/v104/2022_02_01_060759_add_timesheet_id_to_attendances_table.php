<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimesheetIdToAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('timesheet_id')->constrained('timesheets')->onDelete('cascade');
            $table->string('comments')->nullable();
            $table->double('hrs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('timesheet_id');
            $table->dropColumn('comments');
            $table->dropColumn('hrs');
        });
    }
}
