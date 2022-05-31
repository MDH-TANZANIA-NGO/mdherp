<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_type_id')->comment('Type of performance review');
            $table->unsignedBigInteger('user_id')->comment('User how owns the performance');
            $table->unsignedInteger('designation_id')->comment('designation of the user who owns performance report');
            $table->unsignedBigInteger('supervisor_id')->comment('User how supervise the user');
            $table->unsignedBigInteger('parent_id')->comment('self join, id of the previous performance review report');
            $table->unsignedBigInteger('fiscal_year_id')->comment('Current Fiscal Year');
            $table->string('number')->nullable()->comment('unique number of performance review report');
            $table->date('from_at')->comment('start date of review');
            $table->date('to_at')->comment('end date of review');
            $table->boolean('done')->default(false);
            $table->boolean('rejected')->default(false);
            $table->smallInteger('wf_done')->default(0)->comment('workflow status');
            $table->dateTime('wf_done_date')->nullable()->comment('workflow completion date');
            $table->timestamp('submited_at')->nullable()->comment('Submited date of a report');
            $table->uuid('uuid');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('pr_type_id')->references('id')->on('pr_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('supervisor_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('parent_id')->references('id')->on('pr_reports')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_reports');
    }
}
