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
            $table->integer("player_id")->index();
            $table->date("date")->index();
            $table->integer("turn");
            $table->integer("score");
            $table->boolean("dealer");
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
        Schema::dropIfExists('myscores');
    }
}
