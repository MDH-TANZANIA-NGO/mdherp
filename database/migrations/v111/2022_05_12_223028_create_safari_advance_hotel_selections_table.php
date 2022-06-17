<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSafariAdvanceHotelSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safari_advance_hotel_selections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('safari_advance_id');
            $table->bigInteger('hotel_id');
            $table->text('priority_level');
            $table->boolean('reserved')->default('false');
            $table->text('uuid');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('safari_advance_hotel_selections');
    }
}
