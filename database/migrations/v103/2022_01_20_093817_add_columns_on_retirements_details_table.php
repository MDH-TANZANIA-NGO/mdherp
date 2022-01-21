<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnRetirementsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retirements_details', function (Blueprint $table) {
            $table->decimal('amount_spent', 15, 2)->nullable();
            $table->decimal('amount_variance', 15, 2)->nullable();
            $table->string('receipt_attach')->nullable();
            $table->string('supportive_doc_attach')->nullable();
            $table->string('other_attach')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retirements_details', function (Blueprint $table) {
            //
        });
    }
}
