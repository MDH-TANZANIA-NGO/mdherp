<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreatePermissionRoleTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permission_role', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->smallInteger('permission_id');
			$table->smallInteger('role_id');
			$table->timestamps();
			$table->unique(['permission_id','role_id']);
		});
        $this->comment("permission_role", "store the availability of permission for different permission groups");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permission_role');
	}

}
