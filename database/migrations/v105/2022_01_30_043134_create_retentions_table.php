<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retentions', function (Blueprint $table) {
            $table->id();
            $table->date('form_date');
            $table->unsignedBigInteger('data_clerk_id');
            $table->unsignedBigInteger('facility_id');
            $table->integer('tracked');
            $table->integer('returned');
            $table->integer('regularly_attending');
            $table->integer('confirmed_transfer_out');
            $table->integer('not_confirmed_transfer_out');
            $table->integer('opted_out');
            $table->integer('death');
            $table->integer('ltfu');
            $table->integer('promise_to_come');
            $table->integer('wrong_incomp_no_mapcue');
            $table->integer('phone_not_reachable');
            $table->integer('unanswered_call');
            $table->integer('wrong_phone_number');
            $table->integer('not_hiv_positive_client');
            $table->integer('invalid_id');
            $table->integer('attended_other_clinic');
            $table->text('comments');
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
        Schema::dropIfExists('retentions');
    }
}
