<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalRowsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // $table->renameColumn('name', 'first_name');

            $table->string('last_name')->after('first_name')->default(null)->nullable();
            $table->text('about')->after('last_name');
            $table->string('education')->after('about')->default(null)->nullable();
            $table->string('position')->after('education')->default(null)->nullable();
            $table->string('location')->after('position')->default(null)->nullable();
            $table->string('phone')->after('position')->default(null)->nullable();
            $table->json('social')->after('phone');
            $table->string('avatar')->after('social')->default(null)->nullable();
            $table->smallInteger('title')->after('social')->default(null)->nullable();
            $table->boolean('gender')->after('title')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
