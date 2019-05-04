<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->integer('invoice_id');
            $table->string('trace_number', 50)->nullable();
            $table->string('trans_status', 20)->default('inserted');
            $table->string('type', 20);
            $table->string('adapter', 20)->nullable();
            $table->string('status', 20)->default('published');
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
        Schema::dropIfExists('transactions');
    }
}
