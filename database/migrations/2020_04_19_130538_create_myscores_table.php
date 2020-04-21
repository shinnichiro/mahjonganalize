<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myscores', function (Blueprint $table) {
            $table->id();
            $table->biginteger("user_id")->unsigned();
            $table->boolean("player");
            $table->date("date");
            $table->integer("gamesOfDay");
            $table->integer("turn");
            $table->integer("score");
            $table->boolean("dealer");
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('myscores');
    }
}
