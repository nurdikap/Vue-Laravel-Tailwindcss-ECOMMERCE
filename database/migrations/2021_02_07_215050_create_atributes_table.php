<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributes', function (Blueprint $table) {
            $table->id();

            $table->string('atribute', 100);
		    $table->integer('variation_id')->unsigned();
		    
		
		    $table->foreign('variation_id')
		        ->references('id')->on('variations')
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
        Schema::dropIfExists('atributes');
    }
}
