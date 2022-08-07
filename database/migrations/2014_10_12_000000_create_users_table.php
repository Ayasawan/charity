<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
          //  $table->foreignId('role_id')->nullable()->references('id')->on('roles')->nullOnDelete()->cascadeOnUpdate();
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('email')->unique();
            $table->string('password');
            //$table->boolean('active')->default(true);
           // $table->integer('mobile');
            //$table->timestamp('email_verified_at')->nullable();

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
