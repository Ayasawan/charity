<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{

    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('bank_num');
            $table->double('first_paid');
            $table->date('submission_date');
            $table->string('phone');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
