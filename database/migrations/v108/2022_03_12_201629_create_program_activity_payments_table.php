<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramActivityPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_activity_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_id')->nullable();
            $table->bigInteger('program_activity_report_id')->nullable();
            $table->bigInteger('amount_requested')->nullable();
            $table->bigInteger('total_items_amount_paid')->nullable();
            $table->bigInteger('total_participant_amount_paid')->nullable();
            $table->bigInteger('total_amount_paid')->nullable();
            $table->text('uuid');
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('program_activity_payments');
    }
}
