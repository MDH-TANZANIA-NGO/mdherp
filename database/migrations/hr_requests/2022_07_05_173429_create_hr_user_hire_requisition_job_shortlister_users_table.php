<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrUserHireRequisitionJobShortlisterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_user_hire_requisition_job_shortlister_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_user_hire_requisition_job_shortlister_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('hr_user_hire_requisition_job_shortlister_users');
    }
}
