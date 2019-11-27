<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharitySupportFormFildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_support_form_filds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ch_s_form_id');
            $table->integer('order')->default(0);
            $table->string('title');
            $table->string('type');
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
        Schema::dropIfExists('charity_support_form_filds');
    }
}
