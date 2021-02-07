<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50);
		    $table->integer('price')->unsigned()->default(0);
		    $table->integer('transporter_id')->unsigned();
		    
		
		    $table->foreign('transporter_id')
		        ->references('id')->on('transporters')
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
        Schema::dropIfExists('shippings');
    }
}
