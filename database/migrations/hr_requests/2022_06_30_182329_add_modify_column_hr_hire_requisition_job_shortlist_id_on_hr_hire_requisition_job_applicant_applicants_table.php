<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModifyColumnHrHireRequisitionJobShortlistIdOnHrHireRequisitionJobApplicantApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_hire_requisition_job_applicants', function (Blueprint $table) {
            $table->unsignedBigInteger('hr_hire_requisition_job_shortlist_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_hire_requisition_job_applicants', function (Blueprint $table) {
            //
        });
    }
}
