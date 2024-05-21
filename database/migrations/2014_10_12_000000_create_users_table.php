<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    //TODO: posible modificacion de profile luego
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('phone',10)->nullable();
            $table->string('email',100)->unique(); 
            $table->string('profile',100)->default('Empleado');
            $table->enum('status',['Active','Locked'])->default('Active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image',50)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
