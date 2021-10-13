<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorGamesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operator_id');
            $table->string('name');
            $table->decimal('amount');
            $table->integer('operator_scheme_id')->unsigned();
            $table->text('how_it_works');
            $table->boolean('status');
            $table->string('remark');
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
        Schema::drop('operator_games');
    }
}
