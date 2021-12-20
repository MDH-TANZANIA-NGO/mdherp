<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSafariAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safari_advances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount_requested', 15, 2);
            $table->decimal('amount_paid', 15, 2);
            $table->text('number')->nullable();
            $table->longText('scope');
            $table->boolean('wf_done')->default('FALSE');
            $table->timestamp('wf_done_date');
            $table->string('uuid');
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('rejected')->default('FALSE');
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
        Schema::dropIfExists('safari_advances');
    }
}
