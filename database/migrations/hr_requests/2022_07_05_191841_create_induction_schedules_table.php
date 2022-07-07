<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInductionSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('induction_schedules', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('designation_id')->constrained('designations')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('number')->nullable();
            $table->smallInteger('status')->default(0);
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
        Schema::dropIfExists('induction_schedules');
    }
}
