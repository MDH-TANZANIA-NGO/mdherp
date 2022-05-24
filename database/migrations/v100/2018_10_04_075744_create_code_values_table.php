<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreateCodeValuesTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('code_values', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->smallInteger('code_id');
			$table->string('name', 191);
			$table->string('lang', 100)->nullable()->comment('entry to facilitate language translation ');
			$table->text('description')->nullable();
			$table->string('reference', 10)->unique();
			$table->smallInteger('sort');
			$table->smallInteger('isactive')->default(1);
			$table->timestamps();
			$table->unique(['name','code_id']);
		});
        $this->comment("code_values", "store all data dictionaries entries as defined from their parent in codes [data dictionary title] table");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('code_values');
	}

}
