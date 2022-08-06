<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnHrRequisitionJobIdHrInterviewReportrecommendationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('hr_interview_report_recommendations', function (Blueprint $table) {
            $table->unsignedBigInteger('hr_requisition_job_id');
            $table->dropColumn('interview_report_id');
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
