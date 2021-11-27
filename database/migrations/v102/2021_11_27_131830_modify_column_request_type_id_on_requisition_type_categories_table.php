<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnRequestTypeIdOnRequisitionTypeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisition_type_categories', function (Blueprint $table) {
            $table->dropColumn('request_type_id');
            $table->unsignedBigInteger('requisition_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requisition_type_categories', function (Blueprint $table) {
            //
        });
    }
}
