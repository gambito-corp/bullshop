<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('wp_id',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->string('description',255)->nullable();
            $table->string('display',100)->nullable();
            $table->string('image',100)->nullable();
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
        Schema::dropIfExists('categories');
    }
}


// +"name": "Bermudas / Truzas"
//   +"slug": "bermudas-truzas"
//   +"parent": 0
//   +"description": ""
//   +"display": "default"
//   +"image": null
//   +"menu_order": 0
//   +"count": 20
