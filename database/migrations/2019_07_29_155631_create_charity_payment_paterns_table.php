<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharityPaymentPaternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_payment_paterns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->boolean('periodic')->default(0);
            $table->boolean('system')->default(0);
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
        DB::table('charity_payment_paterns')->insert(
            [
                [
                    'title' => 'کمک ماهانه',
                    'description' => 'نیکوکار گرامی، با انتخاب مبلغ و دوره پرداخت دلخواه، شما میتوانید مستمرا در کمک رسانی به افراد تحت پوشش مشارکت نمایید.',
                    'periodic' => '1',
                    'system' => '1',
                    'min' => '10000',
                    'max' => '9000000000',
                    'type' => 'period'
                ],
                [
                    'title' => 'پرداخت آنلاین',
                    'description' => '',
                    'periodic' => '0',
                    'system' => '1',
                    'min' => '10000',
                    'max' => '9000000000',
                    'type' => 'online'

                ]
            ]

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charity_payment_paterns');
    }
}
