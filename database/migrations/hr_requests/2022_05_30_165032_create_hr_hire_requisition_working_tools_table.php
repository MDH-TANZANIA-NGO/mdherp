<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireRequisitionWorkingToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_hire_requisition_working_tools', function (Blueprint $table) { 
            $table->id();
            $table->unsignedBigInteger('hr_requisitions_jobs_id');
            $table->unsignedBigInteger('working_tool_id');
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
        Schema::dropIfExists('hr_hire_requisitions_working_tools');
    }
}
