<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireRequisitionJobApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_hire_requisition_job_applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_hire_requisition_job_shortlists');
            $table->unsignedBigInteger('hr_hire_requisitions_jobs');
            $table->unsignedBigInteger('hr_hire_applicants');
            $table->timestamps();
            $table->foreign('hr_hire_requisition_job_shortlist_id')->references('id')->on('hr_hire_requisition_job_shortlists')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('hr_hire_requisitions_job_id')->references('id')->on('hr_hire_requisitions_jobs')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('hr_hire_applicant_id')->references('id')->on('hr_hire_applicants')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_hire_requisition_job_applicants');
    }
}
