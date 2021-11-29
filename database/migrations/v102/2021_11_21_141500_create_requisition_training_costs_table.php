<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_costs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('expense_id');
            $table->bigInteger('user_id');
            $table->smallInteger('no_days');
            $table->bigInteger('perdiem_rate');
            $table->bigInteger('accomodation');
            $table->bigInteger('transportation');
            $table->bigInteger('other_cost');
            $table->bigInteger('total_amount');
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
        Schema::dropIfExists('training_costs');
    }
}
