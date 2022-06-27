<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrNextObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_next_objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_report_id')->comment('performance review report id');
            $table->longText('goal')->comment('Goal to act upon');
            $table->longText('target')->comment('Accomplishment upon goal set');
            $table->uuid('uuid');
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
        Schema::dropIfExists('pr_next_objectives');
    }
}
