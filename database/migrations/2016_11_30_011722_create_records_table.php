<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('host');
            $table->enum('sport', ['Run', 'Swimming', 'Basketball', 'Volleyball', 'Soccer', 'PingPong', 'Badminton', 'Fitness']);
            $table->dateTime('started_at');
            $table->bigInteger('duration');
            $table->timestamps();
            $table->index('host');
            $table->index('sport');
            $table->foreign('host')->references('name')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
