<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_USUARIO');
            $table->string('title');
            $table->dateTime('end');
            $table->dateTime('start');
            $table->unsignedBigInteger('ID_EVENTOS');
            $table->foreign('ID_EVENTOS')->references('id')->on('event');
            $table->foreign('ID_USUARIO')->references('id')->on('users');
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
        Schema::dropIfExists('calendar');
    }
};
