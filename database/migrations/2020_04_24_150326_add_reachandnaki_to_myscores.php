<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReachandnakiToMyscores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('myscores', function (Blueprint $table) {
            $table->boolean("reacha");
            $table->boolean("reachb");
            $table->boolean("reachc");
            $table->boolean("reachd");
            $table->integer("nakia");
            $table->integer("nakib");
            $table->integer("nakic");
            $table->integer("nakid");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('myscores', function (Blueprint $table) {
            $table->dropColumn("reacha");
            $table->dropColumn("reachb");
            $table->dropColumn("reachc");
            $table->dropColumn("reachd");
            $table->dropColumn("nakia");
            $table->dropColumn("nakib");
            $table->dropColumn("nakic");
            $table->dropColumn("nakid");
        });
    }
}
