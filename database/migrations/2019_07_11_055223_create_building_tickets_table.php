<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->float('predict_percent')->nullable();
            $table->float('actual_percent')->nullable();
            $table->unsignedInteger('creator');
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('item_id')->nullable();
            $table->integer('priority')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('ticket_type')->default(0); //0=>progress 1=>normal
            $table->dateTime('closed')->nullable();
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
        Schema::dropIfExists('building_tickets');
    }
}
