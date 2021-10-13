<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorDirectorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_directors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->bigInteger('phone_number');
            $table->string('email');
            $table->bigInteger('other_phone_number')->nullable();
            $table->integer('is_director_shareholder');
            $table->integer('is_politician');
            $table->integer('has_been_convicted');
            $table->string('conviction_details')->nullable();
            $table->integer('operator_id')->nullable();
            $table->integer('applicant_id')->nullable();
            $table->integer('shareholder_type')->nullable();
            $table->bigInteger('number_of_shares');
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
        Schema::drop('operator_directors');
    }
}
