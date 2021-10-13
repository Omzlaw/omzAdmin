<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesPlayedTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_played', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operator_id');
            $table->string('token');
            $table->integer('status');
            $table->decimal('amount');
            $table->integer('type');
            $table->integer('scheme');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games_played');
    }
}
