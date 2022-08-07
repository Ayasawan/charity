<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{

    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('name');
            $table->string('location');
            $table->text('reason_off_benefit');
            $table->integer('amount');
            $table->date('date');
            $table->integer('age');
            $table->foreignId('charity_id')->constrained('charities')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
}
