<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ColumnReportToHrHireRequisitioinsJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_hire_requisitions_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('report_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_hire_requisitions_jobs', function (Blueprint $table) {
            //
        });
    }
}
