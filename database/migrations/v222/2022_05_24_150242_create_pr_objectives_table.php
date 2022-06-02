<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_report_id')->comment('performance review report id');
            $table->unsignedBigInteger('pr_rate_scale_id')->nullable()->comment('performance review rate scale id');
            $table->longText('goal')->comment('Goal to act upon');
            $table->longText('accomplishment')->nullable()->comment('Accomplishment upon goal set');
            $table->longText('challenge')->nullable()->comment('challenge again goal');
            $table->uuid('uuid');
            $table->timestamps();
            $table->foreign('pr_report_id')->references('id')->on('pr_reports')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('pr_rate_scale_id')->references('id')->on('pr_rate_scales')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_objectives');
    }
}
