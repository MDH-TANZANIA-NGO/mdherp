<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContractProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contract_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_contract_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();
            $table->foreign('user_contract_id')->references('id')->on('user_contracts')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_contract_projects');
    }
}
