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
            $table->string('name',255);
            $table->string('wp_id',255)->nul;
            $table->string('slug')->nullable();
            $table->string('permalink',255)->nullable();
            $table->string('type',255)->nullable();
            $table->string('status',255)->nullable();
            $table->text('description')->nullable();
            $table->string('barcode')->default(0);
            $table->string('price')->default(0);
            $table->string('costo')->default(0);
            $table->string('stock')->nullable();
            $table->string('marca')->nullable();
            $table->string('talla')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
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
