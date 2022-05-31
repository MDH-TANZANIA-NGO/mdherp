<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrRequestsWorkingToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_requests_working_tools', function (Blueprint $table) { 
            $table->id();
            $table->string('description',255);
            $table->unsignedBigInteger('hr_requisitions_jobs_id');
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
        Schema::dropIfExists('hr_requests_working_items_others');
    }
}
