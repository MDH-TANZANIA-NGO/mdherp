<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mchs', function (Blueprint $table) {
            $table->id();
            $table->date('form_date');
            $table->unsignedBigInteger('data_clerk_id');
            $table->unsignedBigInteger('facility_id');
            $table->integer('total_first_attendance_2ab');
            $table->integer('preg_known_pos_5a');
            $table->integer('preg_1st_test_5c');
            $table->integer('preg_1st_test_pos_5d');
            $table->integer('preg_2nd_test_5h');
            $table->integer('preg_2nd_test_pos_5i');
            $table->integer('hei_registered');
            $table->integer('dbs_taken_at_12_mo');
            $table->integer('dbs_taken_below_2_mo');
            $table->integer('mtuha12_facility_delivery_2a');
            $table->integer('mtuha12_non_facility_delivery_2b');
            $table->integer('mtuha12_traditional_delivery_2c');
            $table->integer('mtuha12_home_delivery_2d');
            $table->integer('mtuha12_total_deliveries_2abcd');
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
        Schema::dropIfExists('mchs');
    }
}
