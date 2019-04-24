<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
			$table->string('description')->nullable();
			$table->text('value')->nullable();
			$table->text('default')->nullable();
            $table->string('type');
            $table->string('status', 20)->default('published');
			$table->integer('created_by')->default(1);
			$table->integer('updated_by')->default(1);
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
        Schema::dropIfExists('settings');
    }
}
