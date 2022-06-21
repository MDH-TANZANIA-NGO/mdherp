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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('acceptable')->default(false);
            $table->longText('remarks')->nullable();
            $table->uuid('uuid');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('pr_report_id')->references('id')->on('pr_reports')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('pr_remarks_cv_id')->references('id')->on('code_values')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
