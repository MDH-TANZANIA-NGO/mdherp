<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreateRoleUserTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_user', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->integer('user_id');
			$table->smallInteger('role_id');
			$table->timestamps();
			$table->unique(['user_id','role_id']);
		});
        $this->comment("role_user", "store for each user which permission group they belong ");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_user');
	}

}
