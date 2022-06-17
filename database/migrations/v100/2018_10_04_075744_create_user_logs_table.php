<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Database\TableComment;

class CreateUserLogsTable extends Migration {
    use TableComment;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_logs', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('user_id')->nullable();
			$table->string('has_remember')->nullable();
			$table->smallInteger('user_log_cv_id');
			$table->text('browser')->nullable();
			$table->text('browser_version')->nullable();
			$table->text('device')->nullable();
			$table->text('platform')->nullable();
			$table->text('platform_version')->nullable();
			$table->char('isdesktop')->nullable();
			$table->char('isphone')->nullable();
			$table->char('isrobot')->nullable();
			$table->text('robot_name')->nullable();
			$table->string('username', 30)->nullable();
			$table->char('ismobile')->nullable();
			$table->char('istablet')->nullable();
			$table->text('location')->nullable();
			$table->dateTime('updated_at')->useCurrent();
			$table->dateTime('created_at')->useCurrent();
		});
        $this->comment("user_logs", "Record all the authentication records based on data dictionary title user log");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_logs');
	}

}
