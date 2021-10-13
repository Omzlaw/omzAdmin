<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorLicensesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no');
            $table->integer('operator_id')->unsigned();
            $table->integer('license_type_id')->unsigned();
            $table->date('due_date');
            $table->date('date_last_paid');
            $table->boolean('status');
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
        Schema::drop('operator_licenses');
    }
}
