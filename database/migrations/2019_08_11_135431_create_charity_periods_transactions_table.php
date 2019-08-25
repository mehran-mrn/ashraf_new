<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharityPeriodsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_periods_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('period_id');
            $table->date('payment_date');
            $table->string('amount');
            $table->text('description')->nullable();
            $table->dateTime('pay_date')->nullable();
            $table->integer('gateway_id')->nullable();
            $table->string('status')->default('pending');
            $table->string('review')->default('waiting');
            $table->dateTime('review_datetime')->nullable();
            $table->integer('review_user_id')->nullable();
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
        Schema::dropIfExists('charity_periods_transactions');
    }
}
