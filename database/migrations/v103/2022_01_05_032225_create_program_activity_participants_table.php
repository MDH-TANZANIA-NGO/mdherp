<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramActivityParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_activity_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('g_officer_id');
            $table->unsignedBigInteger('program_activity_id');
            $table->boolean('attended')->default('FALSE');
            $table->boolean('is_substitute')->default('FALSE');
            $table->boolean('substituted')->default('FALSE');
            $table->unsignedBigInteger('substituted_with')->nullable();
            $table->string('uuid');
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('program_activity_participants');
    }
}
