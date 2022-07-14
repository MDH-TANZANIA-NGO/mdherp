<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnHrRequisitionJobIdSkillsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skill_user', function (Blueprint $table) {
            $table->unsignedBigInteger('hr_requisition_job_id');         
            // $table->smallInteger('skill_level_cv_id')->nullable()->change();
            // $table->smallInteger('skill_level_cv_id');
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
