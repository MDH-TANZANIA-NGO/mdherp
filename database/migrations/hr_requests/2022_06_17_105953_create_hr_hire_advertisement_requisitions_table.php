<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireAdvertisementRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_hire_advertisement_requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('done')->default(0);
            $table->smallInteger('rejected')->default(0);
            $table->smallInteger('wf_done')->default(0);
            $table->date('wf_done_date')->nullable();
            $table->unsignedBigInteger('hire_requisition_job_id');
            $table->string('title');
            $table->string('number')->nullable();
            $table->text('description');
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
        Schema::dropIfExists('hr_hire_advertisement_requisitions');
    }
}
