<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingTicketFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_ticket_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('path')->nullable();
            $table->string('mime');
            $table->unsignedInteger('ticket_note_id');
            $table->integer('size')->nullable();
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
        Schema::dropIfExists('building_ticket_files');
    }
}
