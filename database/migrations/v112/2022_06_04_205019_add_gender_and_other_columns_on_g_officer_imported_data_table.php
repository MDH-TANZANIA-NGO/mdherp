<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderAndOtherColumnsOnGOfficerImportedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        //
        Schema::table('gofficer_imported_data', function (Blueprint $table) {
            $table->text('phone2')->nullable();
            $table->bigInteger('gender_cv_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->bigInteger('government_scale_id')->nullable();
            $table->bigInteger('g_scale_id')->nullable();
            $table->text('referenced_uuid')->nullable();

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
