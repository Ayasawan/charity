<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
           // $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('sponsor_id')->constrained('sponsors')->cascadeOnDelete()->default(null);
            $table->integer('age');
            $table->string('gender');
            $table->string('location');
            $table->string('specialize')->nullable();
            $table->integer('academic_years');
            $table->double('value');
            $table->text('description');
            $table->string('phone');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('reqs');
    }
}
