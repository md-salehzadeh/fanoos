<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('price');
            $table->string('description');
            $table->string('type', 20);
            $table->string('invoice_status')->default('inserted');
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
        Schema::dropIfExists('invoices');
    }
}
