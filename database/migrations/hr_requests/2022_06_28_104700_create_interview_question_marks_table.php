<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_interview_question_marks', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('interview_id');
            $table->unsignedBigInteger('applicant_id');
            $table->unsignedBigInteger('panelist_id');
            $table->unsignedBigInteger('interview_question_id');
            $table->double('marks');
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
        Schema::dropIfExists('hr_interview_marks');
    }
}
