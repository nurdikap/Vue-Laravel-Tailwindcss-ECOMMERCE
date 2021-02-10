<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeVariationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_variation', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('attribute_id');
		    $table->unsignedBigInteger('variation_id');
		    		
		    $table->foreign('attribute_id')
		        ->references('id')->on('attributes')
		        ->onDelete('cascade');
		
		    $table->foreign('variation_id')
		        ->references('id')->on('variations')
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
        Schema::dropIfExists('attribute_variation');
    }
}
