<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtHrInterviewPanelistCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //hr_interview_panelist_counters
        Schema::table('hr_interview_panelist_counters', function (Blueprint $table) {
            $table->softDeletes();
            // $table->timestamps();
            // $table->uuid('uuid');
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
