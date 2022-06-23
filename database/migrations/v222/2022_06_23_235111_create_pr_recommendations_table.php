<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_recommendations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_report_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('conform_wef')->nullable();
            $table->string('extend_probation')->nullable();
            $table->boolean('terminate')->nullable();
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
        Schema::dropIfExists('pr_recommendations');
    }
}
