<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireRequisitionJobApplicantRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_hire_requisition_job_applicant_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('number')->nullable()->comment('unique number of performance review report');
            $table->boolean('done')->default(false);
            $table->boolean('rejected')->default(false);
            $table->smallInteger('wf_done')->default(0)->comment('workflow status');
            $table->dateTime('wf_done_date')->nullable()->comment('workflow completion date');
            $table->uuid('uuid');
            $table->softDeletes();
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
        Schema::dropIfExists('hr_hire_requisition_job_applicant_requests');
    }
}
