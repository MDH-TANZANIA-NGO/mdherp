<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_type_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->string('number')->nullable();
            $table->decimal('amount', 15,2)->nullable();
            $table->boolean('done')->default(false);
            $table->boolean('rejected')->default(false);
            $table->smallInteger('wf_done')->default(0);
            $table->dateTime('wf_done_date')->nullable();
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
        Schema::dropIfExists('requisitions');
    }
}
