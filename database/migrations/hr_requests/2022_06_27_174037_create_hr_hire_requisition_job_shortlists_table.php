<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireRequisitionJobShortlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_hire_requisition_job_shortlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('User how owns the performance');
            $table->unsignedBigInteger('supervisor_id')->nullable()->comment('User how supervise the user');
            $table->unsignedBigInteger('fiscal_year_id')->nullable()->comment('Current Fiscal Year');
            $table->unsignedSmallInteger('region_id')->nullable();
            $table->string('number')->nullable()->comment('unique number of performance review report');
            $table->boolean('done')->default(false);
            $table->boolean('rejected')->default(false);
            $table->smallInteger('wf_done')->default(0)->comment('workflow status');
            $table->dateTime('wf_done_date')->nullable()->comment('workflow completion date');
            $table->uuid('uuid');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('supervisor_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_hire_requisition_job_shortlists');
    }
}
