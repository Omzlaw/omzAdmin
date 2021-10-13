<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailBoxesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('subject');
            $table->text('message');
            $table->integer('sent_by')->unsigned();
            $table->integer('received_by')->unsigned();
            $table->boolean('is_read');
            $table->boolean('sender_delete');
            $table->boolean('receiver_delete');
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
        Schema::drop('mail_boxes');
    }
}
