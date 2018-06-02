<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewRowsToClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->text('special_notes')->after('description');
            $table->boolean('general_practice')->after('opening_hours')->default(0);
            $table->boolean('specialist_and_emergency')->after('general_pratice')->default(0);
            $table->boolean('subscribe')->after('specialist_and_emergency')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {}
}
