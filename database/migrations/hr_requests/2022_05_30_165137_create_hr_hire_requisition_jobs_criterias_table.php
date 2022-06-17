<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireRequisitionJobsCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_hire_requisition_jobs_criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_requisitions_jobs_id');
            $table->unsignedBigInteger('education_level');
            $table->unsignedBigInteger('experience_years');
            $table->string('language_proficeince')->nullable();
            $table->string('language')->nullable();
            $table->string('age')->nullable();
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
        Schema::dropIfExists('hr_hire_requisition_jobs_criterias');
    }
}

