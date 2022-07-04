<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrUserHireRequisitionJobShortlistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_user_hire_requisition_job_shortlisters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_user_hire_requisition_job_shortlister_requests');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shortlister_id');
            $table->unsignedBigInteger('hr_hire_requisitions_job_id');
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
        Schema::dropIfExists('hr_user_hire_requisition_job_shortlisters');
    }
}
