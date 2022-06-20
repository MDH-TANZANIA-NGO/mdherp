<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covids', function (Blueprint $table) {
            $table->id();
            $table->date('form_date');
            $table->unsignedBigInteger('data_clerk_id');
            $table->unsignedBigInteger('facility_id');
            $table->integer('attended');
            $table->integer('already_vaccinated');
            $table->integer('vaccine_eligible');
            $table->integer('vaccinated');
            $table->integer('vaccinated_community_art');
            $table->integer('vaccinated_konga');
            $table->integer('vaccinated_home_based');
            $table->integer('vaccinated_routine_fcd');
            $table->integer('vaccinated_cbs');
            $table->integer('vaccinated_others');
            $table->integer('JJ_used');
            $table->integer('MD_used');
            $table->integer('PF_used');
            $table->integer('SN_used');
            $table->integer('JJ_expired');
            $table->integer('MD_expired');
            $table->integer('PF_expired');
            $table->integer('SN_expired');
            $table->integer('JJ_available');
            $table->integer('MD_available');
            $table->integer('PF_available');
            $table->integer('SN_available');
            $table->text('comments')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('form_date_time');
            $table->uuid('uuid');
            $table->softDeletes();
            $table->timestamps();
            $table->smallInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covids');
    }
}
