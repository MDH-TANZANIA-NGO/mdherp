<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrInterviewApplicantMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_interview_applicant_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interview_id');
            $table->unsignedBigInteger('applicant_id');
            $table->double('marks');
            $table->softDeletes();
            $table->uuid('uuid');
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
        Schema::dropIfExists('hr_interveiw_applicant_marks');
    }
}
