<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonCaravansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_caravans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('caravan_id');
            $table->unsignedInteger('person_id');
            $table->dateTime('exit_date')->nullable();
            $table->string('comment')->nullable();
            $table->boolean('accepted')->default('0');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('person_caravans');
    }
}
