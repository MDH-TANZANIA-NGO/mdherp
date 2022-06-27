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
            $table->boolean('confirm_wef')->default(false);
            $table->string('extend_probation')->nullable();
            $table->boolean('terminate')->default(false);
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
