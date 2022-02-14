<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade');
            $table->uuid('uuid');
            $table->string('title');
            $table->integer('number');
            $table->timestamp('date_required');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->smallInteger('prospect_for_appointment_cv_id');
            $table->smallInteger('employment_condition_cv_id');
            $table->longText('education_and_qualification');
            $table->longText('practical_experience');
            $table->longText('other_qualities');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->longText('special_employment_condition')->nullable();
            $table->boolean('is_active')->default(false);
            $table->text('content');
            $table->boolean('budget')->nullable();
            $table->smallInteger('wf_done')->default(0);
            $table->dateTime('wf_done_date')->nullable();
            $table->boolean('rejected')->nullable();
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
        Schema::dropIfExists('listings');
    }
}
