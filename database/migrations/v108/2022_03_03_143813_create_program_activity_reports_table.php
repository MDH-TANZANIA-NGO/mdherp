<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramActivityReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_activity_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('program_activity_id');
            $table->text('number')->nullable();
            $table->boolean('done')->default(false);
            $table->boolean('wf_done')->default(false);
            $table->dateTime('wf_done_date')->nullable();
            $table->boolean('rejected')->default(false);
            $table->bigInteger('user_id');
            $table->bigInteger('region_id');
            $table->text('venue_name')->nullable();
            $table->longText('background_info')->nullable();
            $table->longText('what_was_planned')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('methodology')->nullable();
            $table->longText('achievement')->nullable();
            $table->longText('challenges')->nullable();
            $table->longText('recommendations')->nullable();
            $table->text('status')->nullable();
            $table->date('deleted_at')->nullable();
            $table->text('uuid');
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
        Schema::dropIfExists('program_activity_reports');
    }
}
