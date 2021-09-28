<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreateCodeValueCodeTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('code_value_code', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->smallInteger('code_value_id');
			$table->smallInteger('code_id');
			$table->timestamps();
			$table->unique(['code_value_id','code_id']);
		});
        $this->comment("code_value_code", "store the linkage of one data dictionary entry to other data dictionary titles ");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('code_value_code');
	}

}
