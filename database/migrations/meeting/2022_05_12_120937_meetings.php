<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings',function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->date('date');
        $table->unsignedBigInteger('venue_id');
        $table->unsignedBigInteger('activity_id');
        $table->unsignedBigInteger('budget_id');
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
        Schema::dropIfExists('meetings');
    }
};
