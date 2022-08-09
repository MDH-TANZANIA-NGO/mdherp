<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyHrHireRequisitionJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_hire_requisitions_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('hr_contract_type_id')->nullable()->change();
            $table->text('duties_and_responsibilities')->nullable()->change();
            $table->smallInteger('experience_years')->nullable()->change();
            $table->smallInteger('empoyees_required')->nullable()->change();
            $table->smallInteger('education_level')->nullable()->change();
            $table->text('employment_condition')->nullable()->change();
            $table->smallInteger('start_age')->nullable()->change();
            $table->smallInteger('end_age')->nullable()->change();
            $table->smallInteger('ad_scale')->nullable()->change();
            $table->smallInteger('establishment')->nullable()->change();
            $table->text('practical_experience')->nullable()->change();
            $table->text('special_employment_condition')->nullable()->change();
            // $table->smallInteger('is_advertised')->default(0);
            $table->text('special_qualities_skills')->nullable()->change();
            $table->date('date_required')->nullable()->change();
            // $table->float('budget')->nullable();
            $table->unsignedBigInteger('appointement_prospects_id')->nullable()->change();
            // $table->text('education_and_qualification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
