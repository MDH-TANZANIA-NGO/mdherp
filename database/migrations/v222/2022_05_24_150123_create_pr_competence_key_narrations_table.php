<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrCompetenceKeyNarrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_competence_key_narrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_competence_key_id');
            $table->string('narration')->comment('different narrations of the competence keys');
            $table->timestamps();
            $table->foreign('pr_competence_key_id')->references('id')->on('pr_competence_keys')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_competence_key_narrations');
    }
}
