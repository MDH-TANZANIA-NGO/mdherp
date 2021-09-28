<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreateSysdefsTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sysdefs', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->string('name');
			$table->string('display_name');
			$table->string('value')->nullable();
			$table->string('data_type');
			$table->smallInteger('isactive')->default(1);
			$table->string('reference');
			$table->smallInteger('sysdef_group_id');
		});
        $this->comment("sysdefs", "store system constant values, control variables and configurations");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sysdefs');
	}

}
