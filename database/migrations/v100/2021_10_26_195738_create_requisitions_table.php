<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('requested_amount');
            $table->unsignedBigInteger('district_id');
            $table->integer('numerical_output');
            $table->string('status')->nullable();
            $table->tinyInteger('type');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('activities')
                ->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict');
            $table->foreign('district_id')->references('id')->on('districts')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisitions');
    }
}
