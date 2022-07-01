<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserRecruitmentIdOnHrHireApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_hire_applicants', function (Blueprint $table) {
            $table->unsignedBigInteger('user_recruitment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_hire_applicants', function (Blueprint $table) {
            //
        });
    }
}
