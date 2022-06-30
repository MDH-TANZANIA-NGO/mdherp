<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffHiringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_hirings', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_name')->nullable();
            $table->string('know_period');
            $table->string('know_capacity');
            $table->longText('relate');
            $table->string('rate_proffesional');
            $table->string('rate_commitment');
            $table->string('rate_knowledge');
            $table->string('rate_trust');
            $table->string('rate_deadlines');
            $table->string('rate_relationship_with_others');
            $table->longText('general_opinion');
            $table->string('ref_name');
            $table->string('ref_email');
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
        Schema::dropIfExists('staff_hirings');
    }
}
