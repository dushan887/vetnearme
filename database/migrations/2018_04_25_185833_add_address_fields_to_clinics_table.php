<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressFieldsToClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {

            $table->string('city')->after('phone_number2');
            $table->string('zip')->after('address');
            $table->integer('country_id')->after('zip')->unsigned();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
