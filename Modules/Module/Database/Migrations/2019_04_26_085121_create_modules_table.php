<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->string('description');
            $table->string('version', 10);
            $table->date('release_date');
            $table->string('dependencies')->nullable();
            $table->string('author_name');
            $table->string('author_email');
            $table->tinyInteger('active')->default(1);
			$table->dateTime('created_at')->useCurrent();
			$table->dateTime('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
