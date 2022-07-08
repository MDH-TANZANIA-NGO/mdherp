<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnHrHireRequisitionJobIdOnHrUserHireRequisitionJobShortlisterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_user_hire_requisition_job_shortlister_users', function (Blueprint $table) {
            $table->unsignedBigInteger('hr_hire_requisitions_job_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_user_hire_requisition_job_shortlister_users', function (Blueprint $table) {
            //
        });
    }
}
