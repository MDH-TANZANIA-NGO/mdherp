<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramActivityHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_activity_hotels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('program_activity_id');
            $table->bigInteger('hotel_id');
            $table->text('priority_level');
            $table->boolean('reserved')->default('false');
            $table->text('uuid');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('program_activity_hotels');
    }
}
