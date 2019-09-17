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
            $table->string('executer')->nullable();//mojri karevan
            $table->integer('capacity');//null => infinite
            $table->unsignedInteger('dep_province')->nullable();
            $table->unsignedInteger('dep_city')->nullable();
            $table->unsignedInteger('caravan_host_id');
            $table->unsignedInteger('duty');
            $table->string('budget')->nullable();
            $table->string('title')->nullable();
            $table->string('transport')->nullable();
            $table->dateTime('start');
            $table->dateTime('arrival')->nullable();
            $table->dateTime('departure')->nullable();
            $table->dateTime('end')->nullable();
            $table->integer('status')->default('1');//0 cancel //1 in progress //2 closed list // 3 arrived // 4 exited // 5  archived
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
