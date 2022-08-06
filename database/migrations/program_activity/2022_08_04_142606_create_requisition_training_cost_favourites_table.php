<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionTrainingCostFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_training_cost_favourites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->text('name');
            $table->timestamp('deleted_at')->nullable();
            $table->string('uuid');
            $table->bigInteger('requisition_id');
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
        Schema::dropIfExists('requisition_training_cost_favourites');
    }
}
