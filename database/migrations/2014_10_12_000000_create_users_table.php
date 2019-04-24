<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->engine = 'InnoDB';
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->string('username')->unique()->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email', 50)->unique()->nullable();
            $table->string('mobile', 20)->unique()->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('password', 100)->nullable();
			$table->rememberToken()->nullable();
            $table->string('status', 20)->default('published');
			$table->string('activation_code')->nullable();
            $table->text('socials')->nullable();
            $table->text('opts')->nullable();
            $table->integer('access')->default(1);
            $table->tinyInteger('verified')->default(0);
            $table->tinyInteger('active')->default(1);
			$table->integer('created_by')->default(1);
			$table->integer('updated_by')->default(1);
			$table->dateTime('created_at')->useCurrent();
			$table->dateTime('updated_at')->useCurrent();

			$table->index(['email', 'status', 'created_at']);
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
