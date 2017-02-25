<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->string('user');
            $table->integer('activity');
            $table->enum('relation', ['own', 'apply', 'participate', 'reject']);
            $table->timestamps();
            $table->primary(['user', 'activity']);
            $table->foreign('user')->references('name')->on('users');
            $table->foreign('activity')->references('id')->on('activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activities');
    }
}
