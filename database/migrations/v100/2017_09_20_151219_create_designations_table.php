<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesignationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('designations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('short_name')->nullable()->comment('Short name of the long designation name.');
			$table->smallInteger('isactive')->default(1);
			$table->integer('unit_id');
			$table->timestamps();
			$table->softDeletes();
			$table->unique(['name','short_name']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('designations');
	}

}
