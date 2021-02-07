<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->enum('status', ['pending', 'canceled', 'aprobed'])->default('pending');
		    $table->integer('amount');
		    $table->string('provider', 200);
		    $table->integer('order_id')->unsigned();
		    		
		    $table->foreign('order_id')
		        ->references('id')->on('orders')
		        ->onDelete('cascade')
		        ->onUpdate('restrict');


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
        Schema::dropIfExists('transactions');
    }
}
