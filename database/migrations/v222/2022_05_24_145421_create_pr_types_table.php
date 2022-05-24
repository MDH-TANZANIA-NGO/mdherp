<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('This column represent type of Performance review. i.e Probationary, mid year and Final Review at the End of the Year');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE 'pr_types' comment 'Store Performance Review Types'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_types');
    }
}
