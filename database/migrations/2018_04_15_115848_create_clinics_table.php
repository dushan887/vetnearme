<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->string('email');
            $table->string('phone_number');
            $table->string('phone_number2');
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->string('gmaps_link');
            $table->json('social_media');
            $table->json('opening_hours');
            $table->string('logo')->nullable();
            $table->integer('owner_id')->nullable()->unsigned();
            $table->timestamps();

            $table->index('owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
