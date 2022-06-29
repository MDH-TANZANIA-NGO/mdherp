<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_interviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_requisition_job_id');
            $table->smallInteger('interview_type_id');
            $table->smallInteger('is_invited')->default(0);
            $table->unsignedBigInteger('shortlist_id');
            $table->string('number')->nullable();
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
        Schema::dropIfExists('hr_interviews');
    }
}
