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
            $table->unsignedBigInteger('hr_hire_requisition_job_shortlist_id');
            $table->unsignedBigInteger('hr_hire_requisitions_job_id');
            $table->unsignedBigInteger('hr_hire_applicant_id');
            $table->timestamps();
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
