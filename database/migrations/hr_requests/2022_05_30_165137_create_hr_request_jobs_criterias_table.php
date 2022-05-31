<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrRequestJobsCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_request_jobs_criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_requests_jobs_id');
            $table->unsignedBigInteger('qualification_id');
            $table->unsignedBigInteger('qualification_resource_type');
            $table->unsignedBigInteger('experience_years');
            $table->smallInteger('is_mandatory')->nullable();
            $table->smallInteger('is_advantage')->nullable();
            $table->text('comment');
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
        Schema::dropIfExists('hr_job_qualification');
    }
}
