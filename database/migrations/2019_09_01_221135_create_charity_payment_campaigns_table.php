<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharityPaymentCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_payment_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pattern_id');
            $table->string('title')->nullable();
            $table->dateTime('start_date')->default(date("Y-m-d H:i:s"));
            $table->dateTime('end_date')->default(date("Y-m-d H:i:s"));
            $table->string('target')->default(0);
            $table->string('payment_code')->nullable();
            $table->integer('gateway_id')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->string('file_id')->nullable();
            $table->string('sheba')->nullable();
            $table->string('account_number')->nullable();
            $table->string('card_number')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('charity_payment_campaigns');
    }
}
