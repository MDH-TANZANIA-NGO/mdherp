<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorUserTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supervisor_id')->comment('this is users id');
            $table->unsignedBigInteger('user_id')->comment('this is users id');
            $table->timestamps();
//            $table->unique(['supervisor_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
