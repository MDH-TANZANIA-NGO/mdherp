<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrHireRequisitionReplacedStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('hr_hire_requisition_replaced_staffs', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id');    
            $table->unsignedBigInteger('hr_requisition_job_id');         
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
        Schema::dropIfExists('hr_hire_requisition_replaced_staffs');
    }
}
