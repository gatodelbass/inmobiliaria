<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();           
            //$table->foreignId('type_id')->constrained();        
            $table->string('title');
            $table->string('condition')->default("Nuevo");            
            $table->integer('cost')->default(0); 
            $table->integer('discount')->default(0);           
            $table->integer('quantity')->default(0);           
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->text('key3')->nullable();
            $table->string('status')->default("Activo");
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
        Schema::dropIfExists('properties');
    }
}
