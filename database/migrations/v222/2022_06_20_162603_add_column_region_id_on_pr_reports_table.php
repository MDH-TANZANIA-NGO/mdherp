<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRegionIdOnPrReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pr_reports', function (Blueprint $table) {
            $table->unsignedSmallInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pr_reports', function (Blueprint $table) {
            //
        });
    }
}
