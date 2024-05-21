<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('total',10,2);
            $table->decimal('descuento',10,2)->default(0);
            $table->decimal('final',10,2);
            $table->string('costoTotal')->nullable();
            $table->integer('items');
            $table->decimal('cash',10,2);
            $table->decimal('change',10,2);
            $table->enum('status',['PAID','PENDING','CANCELLED'])->default('PAID');
            $table->string('medio', 20)->default('Efectivo');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('sales');
    }
}
