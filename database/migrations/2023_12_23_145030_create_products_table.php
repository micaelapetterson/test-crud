<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->string('brand');
            $table->unsignedBigInteger('categories_id');
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('price_sale', 8, 2)->default(0);
            $table->integer('stock')->default(0)->unsigned()->nullable(false)->length(5);
            $table->timestamps();

            $table->foreign('categories_id')->references('id')->on('categories');
        });
    }


    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
