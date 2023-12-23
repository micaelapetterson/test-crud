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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->string('brand');
            $table->unsignedBigInteger('category_id');
            $table->decimal('price', 8, 2);
            $table->decimal('price_sale', 8, 2);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
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
