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
            $table->float('rating');
            $table->integer('rating_count');
            $table->string('image');
            $table->unsignedBigInteger('category_id');
            $table->string('size');
            $table->string('color');
            $table->float('price');
            $table->timestamps();
            $table->float('discount')->default(0);
            $table->boolean('is_recent')->default(true);
            $table->boolean('is_featured')->default(true);
            $table->foreign('category_id')->references('id')->on('categories')->restrictOnDelete();
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
};
