<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('RC_number');
            $table->string('address');
            $table->string('phone');
            $table->string('website');
            $table->string('logo')->nullable();
            $table->json('documents')->nullable();
            $table->string('email');
            $table->integer('no_of_shareholders')->nullable();
            $table->integer('no_of_directors')->nullable();
            $table->integer('has_previously_applied')->nullable();
            $table->integer('has_pending_application')->nullable();
            $table->text('prev_application_details')->nullable();
            $table->integer('accept_terms');
            $table->integer('user_id')->nullable();
            $table->integer('operator_id')->nullable();
            $table->smallInteger('application_status')->nullable();
            $table->smallInteger('final_submission')->nullable();
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
        Schema::drop('applicants');
    }
}
