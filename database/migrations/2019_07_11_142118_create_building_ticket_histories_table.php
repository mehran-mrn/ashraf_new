<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingTicketHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_ticket_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->dateTime('time');
            $table->unsignedInteger('building_ticket_id');
            $table->unsignedInteger('building_ticket_note_id')->nullable();
            $table->integer('history_type')->default(0);
            // 0 => created 1=> add note 2 =>refer 3=>assign to self 4=>close 5=> approve 6=> reject 7 => reOpen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building_ticket_histories');
    }
}
