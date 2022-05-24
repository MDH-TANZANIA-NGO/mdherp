<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrCompetenceKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_competence_keys', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('competence key title');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE 'pr_competence_keys' comment 'Store Performance Review Competence Keys'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_competence_keys');
    }
}
