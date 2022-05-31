<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrRequestsJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_requests_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_jobs_id');
            $table->unsignedBigInteger('hr_contract_type_id');
            $table->unsignedBigInteger('employment_condition');
            $table->smallInteger('experience_years');
            $table->smallInteger('positions');
            $table->smallInteger('ad_scale');
            $table->smallInteger('establishment');
            $table->smallInteger('practical_experience');
            $table->text('special_qualities_skills');
            $table->text('comment');
            $table->uuid('uuid');
            $table->unsignedBigInteger('appointement_prospects_id');
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
        Schema::dropIfExists('hr_requests_jobs');
    }
}
