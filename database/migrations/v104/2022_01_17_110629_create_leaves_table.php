<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade');
            $table->integer('leave_balance');
            $table->foreignId('leave_type_id')->constrained('leave_types')->onDelete('cascade');
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
        Schema::dropIfExists('leaves');
    }
}
