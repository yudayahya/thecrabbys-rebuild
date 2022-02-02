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
            $table->string('nama');
            $table->string('slug');
            $table->integer('harga');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->boolean('best_seller')->default('0')->comment('1 = best seller');
            $table->boolean('in_stock')->default('0')->comment('1 = in stock');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action')->onUpdate('no action');
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
