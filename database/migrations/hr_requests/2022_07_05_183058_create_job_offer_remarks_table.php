<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOfferRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offer_remarks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_offer_id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('applicant_id')->nullable();
            $table->longText('comments');
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('is_closed')->default('false');
            $table->string('uuid');
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
        Schema::dropIfExists('job_offer_remarks');
    }
}
