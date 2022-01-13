<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retirements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('safari_advance_id');
            $table->decimal('amount_requested', 15, 2);
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('amount_received', 15, 2);
            $table->longText('activity_report');
            $table->boolean('wf_done')->default('FALSE');
            $table->timestamp('wf_done_date');
            $table->string('uuid');
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('rejected')->default('FALSE');
            $table->unsignedBigInteger('done')->default(0);

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
        Schema::dropIfExists('retirement');
    }
}
