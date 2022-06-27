<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireRequisitionJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_hire_requisitions_jobs', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('department_id');
            $table->unsignedBigInteger('hire_requisition_id');
            $table->unsignedBigInteger('hr_contract_type_id');
            $table->unsignedBigInteger('designation_id');
            // $table->string('number');
            $table->text('special_employment_condition')->nullable();
            $table->text('duties_and_responsibilities');
            $table->smallInteger('experience_years')->nullable();
            $table->smallInteger('empoyees_required');
            $table->smallInteger('education_level');
            $table->smallInteger('employment_condition');
            $table->smallInteger('start_age')->nullable();
            $table->smallInteger('end_age')->nullable();
            $table->smallInteger('ad_scale')->nullable();
            $table->smallInteger('establishment');
            $table->smallInteger('practical_experience')->nullable();
            $table->smallInteger('is_advertised')->default(0);
            $table->text('special_qualities_skills')->nullable();
            $table->date('date_required');
            $table->float('budget')->nullable();
            $table->unsignedBigInteger('appointement_prospects_id');
            $table->text('education_and_qualification')->nullable();
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
        Schema::dropIfExists('hr_hire_requisitions_jobs');
    }
}
