<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContractProjectDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contract_project_designations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_contract_project_id');
            $table->unsignedInteger('designation_id');
            $table->timestamps();
            $table->foreign('user_contract_project_id')->references('id')->on('user_contract_projects')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_contract_project_designations');
    }
}
