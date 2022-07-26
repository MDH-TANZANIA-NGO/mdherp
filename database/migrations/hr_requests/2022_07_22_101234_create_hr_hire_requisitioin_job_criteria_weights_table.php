<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireRequisitioinJobCriteriaWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_hire_requisitioin_job_criteria_weights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_requisition_job_id');
            $table->unsignedBigInteger('hr_hire_requisitioin_job_criteria_id');
            $table->double('weight');
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
        Schema::dropIfExists('hr_hire_requisitioin_job_criteria_weights');
    }
}
