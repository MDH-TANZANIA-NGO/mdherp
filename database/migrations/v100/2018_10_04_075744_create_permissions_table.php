<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreatePermissionsTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->string('name', 150);
			$table->text('display_name');
			$table->text('description')->nullable();
			$table->smallInteger('ischecker')->default(0)->comment('set whether this permission needs a second person check ');
			$table->timestamps();
		});
        $this->comment("permissions", "store the permissions for the logistic services entries");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permissions');
	}

}
