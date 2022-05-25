<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('title of attribute');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE 'pr_attributes' comment 'Store Performance Review Attributes for probation form'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_attributes');
    }
}
