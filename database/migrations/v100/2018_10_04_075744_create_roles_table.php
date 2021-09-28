<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreateRolesTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->string('name', 120);
			$table->text('description')->nullable();
			$table->smallInteger('isfree')->default(1)->comment('specify whether the permission is for free or not free i.e. 1. Free, 0. Not Free');
			$table->smallInteger('isadministrative')->default(0)->comment('specify whether it is the permission for internal TPSF staff');
            $table->smallInteger('isactive')->default(1);
			$table->timestamps();
		});
        $this->comment("roles", "store the permission groups for the portal services usage ");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
	}

}
