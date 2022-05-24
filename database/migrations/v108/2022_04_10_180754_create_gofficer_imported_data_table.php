<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGofficerImportedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gofficer_imported_data', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('phone')->unique();
            $table->bigInteger('region_id');
            $table->longText('password');
            $table->longText('fingerprint_data');
            $table->bigInteger('fingerprint_length');
            $table->string('check_no')->nullable();
            $table->bigInteger('user_id');
            $table->boolean('duplicated')->default(false);
            $table->boolean('uploaded')->default(false);
            $table->string('file_name')->nullable();

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
        Schema::dropIfExists('gofficer_imported_data');
    }
}
