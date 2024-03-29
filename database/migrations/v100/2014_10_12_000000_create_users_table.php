<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('identity_number')->nullable();
            $table->string('name')->nullable();
            $table->integer('user_account_cv_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->smallInteger('gender_cv_id')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('isactive')->default(1);
            $table->integer('designation_id')->unsigned()->nullable();
            $table->integer('region_id')->nullable();
            $table->date('dob')->nullable();
            $table->date('employed_date')->nullable();
            $table->uuid('uuid');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
