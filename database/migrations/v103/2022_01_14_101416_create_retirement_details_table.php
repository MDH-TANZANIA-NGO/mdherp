<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetirementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retirement_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('safari_advance_id');
            $table->text('number')->nullable();
            $table->date('from');
            $table->date('to');
            $table->unsignedBigInteger('district_id');
            $table->decimal('amount_requested', 15, 2)->nullable();
            $table->decimal('amount_paid', 15, 2)->nullable();
            $table->decimal('amount_received', 15, 2)->nullable();
            $table->longText('activity_report');
            $table->date('deleted_at')->nullable();
            $table->string('uuid')->nullable();
            $table->string('attachment_receipt')->nullable();
            $table->string('attachment_supportive')->nullable();
            $table->string('attachment_other')->nullable();

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
        Schema::dropIfExists('retirement_details');
    }
}
