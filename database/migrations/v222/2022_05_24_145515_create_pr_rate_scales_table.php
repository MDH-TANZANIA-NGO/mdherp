<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrRateScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_rate_scales', function (Blueprint $table) {
            $table->id();
            $table->string('description')->comment('description of rate');
            $table->smallInteger('rate','',1)->comment('numerical Representative of score');
        });
        \DB::statement("ALTER TABLE 'pr_rate_scales' comment 'Store Performance Review Rate Scales'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_rate_scales');
    }
}
