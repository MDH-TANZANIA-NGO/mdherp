<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreateCountriesTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->string('name', 191);
			$table->dateTime('created_at')->nullable()->useCurrent();
			$table->string('code', 2);
			$table->uuid('uuid');
		});
        $this->comment("countries", "list of all countries in the world");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}

}
