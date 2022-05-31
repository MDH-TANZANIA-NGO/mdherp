<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrRequestReplacedStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('hr_request_replaced_staffs', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id');    
            $table->unsignedBigInteger('hr_requisition_jobs_id');         
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
        Schema::dropIfExists('hr_jobs_replaced');
    }
}
