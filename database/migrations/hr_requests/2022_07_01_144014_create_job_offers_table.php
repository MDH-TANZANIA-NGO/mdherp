<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hr_hire_requisitions_job_id');
            $table->bigInteger('parent_id')->nullable();
            $table->decimal('salary', 15, 2);
            $table->longText('details')->nullable();
            $table->boolean('done')->default(false);
            $table->boolean('rejected')->default(false);
            $table->bigInteger('wf_done')->nullable();
            $table->timestamp('wf_done_date')->nullable();
            $table->string('uuid');
            $table->timestamp('deleted_at');
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
        Schema::dropIfExists('job_offers');
    }
}
