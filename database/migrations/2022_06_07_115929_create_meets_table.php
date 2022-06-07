<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('user')->nullable();
            $table->string('title')->nullable();
            $table->integer('mobile_number')->nullable();
            $table->string('registration_name')->nullable();
            $table->string('work_place')->nullable();
            $table->string('district_name')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meets');
    }
}
