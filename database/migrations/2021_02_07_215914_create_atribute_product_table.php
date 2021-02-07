<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribute_product', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')->unsigned();
		    $table->integer('atribute_id')->unsigned();
		    
		
		    $table->foreign('atribute_id')
		        ->references('id')->on('atributes')
		        ->onDelete('cascade')
		        ->onUpdate('restrict');
		
		    $table->foreign('product_id')
		        ->references('id')->on('products')
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
        Schema::dropIfExists('atribute_product');
    }
}
