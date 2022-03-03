<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSafariAdvancePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safari_advance_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('safari_advance_id')->nullable();
            $table->bigInteger('payment_id')->nullable();
            $table->bigInteger('requisition_id')->nullable();
            $table->decimal('requested_amount', 15, 2)->nullable();
            $table->decimal('disbursed_amount',15 , 2)->nullable();
            $table->text('account_no')->nullable();
            $table->boolean('done')->default('false');
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
        Schema::dropIfExists('safari_advance_payments');
    }
}
