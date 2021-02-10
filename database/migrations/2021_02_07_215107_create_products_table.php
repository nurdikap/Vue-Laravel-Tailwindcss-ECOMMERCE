<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
		    $table->string('price', 100);
		    $table->integer('discount');
		    $table->longText('description');
		    $table->string('reference', 100);
		    $table->unsignedBigInteger('subcategory_id');
		    $table->string('short_description', 300);
            $table->boolean('look_for_stock');
		    $table->json('images');
		    $table->enum('product_type', ['simple', 'variable'])->default('simple');
		    $table->integer('stock');
		    
		
		    $table->foreign('subcategory_id')
		        ->references('id')->on('subcategories')
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
        Schema::dropIfExists('products');
    }
}
