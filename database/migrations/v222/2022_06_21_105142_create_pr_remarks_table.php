<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_remarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_report_id');
            $table->unsignedInteger('pr_remarks_cv_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('acceptable')->default(true);
            $table->longText('remarks');
            $table->uuid('uuid');
            $table->softDeletes();
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
        Schema::dropIfExists('pr_remarks');
    }
}
