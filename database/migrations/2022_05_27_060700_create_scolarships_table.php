<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScolarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scolarships', function (Blueprint $table) {
            $table->id();
            $table->integer('max_number');
            $table->text('description');
            $table->text('image');
            $table->integer('academic_years');
            $table->bigInteger('college_id');
            $table->bigInteger('charity_id');
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
        Schema::dropIfExists('scolarships');
    }
}