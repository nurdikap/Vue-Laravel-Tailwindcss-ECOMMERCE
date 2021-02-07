<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id');
		    $table->enum('payment_method', ['efectivo', 'pasarela']);
		    $table->unsignedBigInteger('shipping_id');
		    $table->integer('final_price')->unsigned();
		    $table->integer('price')->unsigned();
		    $table->integer('discount')->unsigned();
		    $table->unsignedBigInteger('coupon_id');
		    		
		    $table->foreign('client_id')
		        ->references('id')->on('clients')
		        ->onDelete('cascade')
		        ->onUpdate('restrict');
		
		    $table->foreign('shipping_id')
		        ->references('id')->on('shippings')
		        ->onDelete('cascade')
		        ->onUpdate('restrict');
		
		    $table->foreign('coupon_id')
		        ->references('id')->on('coupons')
		        ->onDelete('cascade');

                
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
        Schema::dropIfExists('orders');
    }
}
