<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuidToFleetRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fleet_requests', function (Blueprint $table) {
            $table->text('uuid')->nullable();
            $table->integer('wf_done')->default(0)->nullable();
            $table->dateTime('wf_done_date')->nullable();
            $table->boolean('rejected')->default(false)->nullable();
            $table->bigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fleet_requests', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('user_id');
            $table->dropColumn('wf_done');
            $table->dropColumn('wf_done_date');
            $table->dropColumn('rejected');
        });
    }
}
