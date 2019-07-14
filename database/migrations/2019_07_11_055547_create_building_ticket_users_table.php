<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingTicketUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_ticket_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('assigned')->default(0);
            $table->integer('action_type')->default(0);
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
        Schema::dropIfExists('building_ticket_users');
    }
}
