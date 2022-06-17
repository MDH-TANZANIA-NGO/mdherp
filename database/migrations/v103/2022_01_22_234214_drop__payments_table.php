<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('reference');
            $table->dropColumn('referenced_table');
            $table->boolean('wf_done')->default(false);
            $table->integer('done')->default(0);
            $table->date('wf_done_date')->nullable();
            $table->boolean('rejected')->default(false);
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->unsignedBigInteger('requisition_id')->nullable();
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
