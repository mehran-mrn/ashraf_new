<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharityPaymentFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_payment_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->boolean('require')->default(0);
            $table->unsignedInteger('ch_pay_pattern_id');
            $table->unsignedInteger('type')->default(0);//0=input ,1=textarea 2=number 3=date 4=time
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
        Schema::dropIfExists('charity_payment_fields');
    }
}
