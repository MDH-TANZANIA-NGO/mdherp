<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreateCodesTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codes', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->string('name', 150);
			$table->string('lang', 150)->nullable()->comment('entry to facilitate language translation ');
			$table->smallInteger('is_system_defined')->default(1)->comment('the code defined with this will never be available for editing ');
			$table->timestamps();
		});
        $this->comment("codes", "store all data dictionaries titles");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('codes');
	}

}
