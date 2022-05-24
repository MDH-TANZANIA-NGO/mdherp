<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrCompentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_competences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_report_id')->comment('performance review report id');
            $table->unsignedBigInteger('pr_competence_key_narration_id')->comment('performance review competence key narration id');
            $table->unsignedBigInteger('pr_rate_scale_id')->comment('performance review rate scale id');
            $table->uuid('uuid');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('pr_report_id')->references('id')->on('pr_reports')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('pr_competence_key_narration_id')->references('id')->on('pr_competence_key_narrations')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('pr_rate_scale_id')->references('id')->on('pr_rate_scales')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
        \DB::statement("ALTER TABLE 'pr_competences' comment 'Store Performance Review Competences'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_compentences');
    }
}
