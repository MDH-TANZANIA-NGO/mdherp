<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_reports', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->uuid('uuid');
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('report_type')->nullable();
            $table->smallInteger('wf_done')->default(0);
            $table->timestamp('wf_done_date')->nullable();
            $table->boolean('rejected')->default(false);
            $table->boolean('done')->default(false);
            $table->bigInteger('region_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->boolean('complete')->default(false);
            $table->boolean('has_attachments')->default(false);
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
        Schema::dropIfExists('activity_reports');
    }
}
