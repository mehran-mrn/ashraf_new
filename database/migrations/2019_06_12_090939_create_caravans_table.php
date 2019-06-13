<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaravansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caravans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('capacity');//null => infinite
            $table->unsignedInteger('dep_province')->nullable();
            $table->unsignedInteger('dep_city')->nullable();
            $table->unsignedInteger('caravan_host_id');
            $table->unsignedInteger('duty');
            $table->string('budget')->nullable();
            $table->string('transport')->nullable();
            $table->dateTime('start');
            $table->dateTime('arrival')->nullable();
            $table->dateTime('departure')->nullable();
            $table->dateTime('end')->nullable();
            $table->integer('status')->default('0');
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
        Schema::dropIfExists('caravans');
    }
}
