<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountColumnsOnRetirementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retirement_details', function (Blueprint $table) {
//            $table->decimal('amount_spent', 15, 2)->nullable();
//            $table->decimal('amount_variance', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retirement_details', function (Blueprint $table) {
            //
        });
    }
}
