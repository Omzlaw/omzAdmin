<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseChecklistsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_checklists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requirement');
            $table->boolean('is_lottery');
            $table->boolean('is_sportbet');
            $table->boolean('is_mobile_gaming');
            $table->boolean('is_promo');
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
        Schema::drop('license_checklists');
    }
}
