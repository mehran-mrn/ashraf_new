<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('card_number')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        $data = array(
            array('name' => trim('﻿بانک اقتصاد نوین'), 'card_number' => '627412'),
            array('name' => trim('بانک انصار'), 'card_number' => '627381'),
            array('name' => trim('بانک ایران زمین'), 'card_number' => '505785'),
            array('name' => trim('بانک پارسیان'), 'card_number' => '622106'),
            array('name' => trim('بانک پارسیان'), 'card_number' => '639194'),
            array('name' => trim('بانک پارسیان'), 'card_number' => '627884'),
            array('name' => trim('بانک پاسارگاد'), 'card_number' => '639347'),
            array('name' => trim('بانک پاسارگاد'), 'card_number' => '502229'),
            array('name' => trim('بانک تات'), 'card_number' => '636214'),
            array('name' => trim('بانک تجارت'), 'card_number' => '627353'),
            array('name' => trim('بانک توسعه تعاون'), 'card_number' => '502908'),
            array('name' => trim('بانک توسعه صادرات ایران'), 'card_number' => '627648'),
            array('name' => trim('بانک توسعه صادرات ایران'), 'card_number' => '207177'),
            array('name' => trim('بانک حکمت ایرانیان'), 'card_number' => '636949'),
            array('name' => trim('بانک دی'), 'card_number' => '502938'),
            array('name' => trim('بانک رفاه کارگران'), 'card_number' => '589463'),
            array('name' => trim('بانک سامان'), 'card_number' => '621986'),
            array('name' => trim('بانک سپه'), 'card_number' => '589210'),
            array('name' => trim('بانک سرمایه'), 'card_number' => '639607'),
            array('name' => trim('بانک سینا'), 'card_number' => '639346'),
            array('name' => trim('بانک شهر'), 'card_number' => '502806'),
            array('name' => trim('بانک صادرات ایران'), 'card_number' => '603769'),
            array('name' => trim('بانک صنعت و معدن'), 'card_number' => '627961'),
            array('name' => trim('بانک قرض الحسنه مهر ایران'), 'card_number' => '606373'),
            array('name' => trim('بانک قوامین'), 'card_number' => '639599'),
            array('name' => trim('بانک کارآفرین'), 'card_number' => '627488'),
            array('name' => trim('بانک کارآفرین'), 'card_number' => '502910'),
            array('name' => trim('بانک کشاورزی'), 'card_number' => '603770'),
            array('name' => trim('بانک کشاورزی'), 'card_number' => '639217'),
            array('name' => trim('بانک گردشگری'), 'card_number' => '505416'),
            array('name' => trim('بانک مرکزی'), 'card_number' => '636795'),
            array('name' => trim('بانک مسکن'), 'card_number' => '628023'),
            array('name' => trim('بانک ملت'), 'card_number' => '610433'),
            array('name' => trim('بانک ملت'), 'card_number' => '991975'),
            array('name' => trim('بانک ملی ایران'), 'card_number' => '603799'),
            array('name' => trim('بانک مهر اقتصاد'), 'card_number' => '639370'),
            array('name' => trim('پست بانک ایران'), 'card_number' => '627760'),
            array('name' => trim('موسسه اعتباری توسعه'), 'card_number' => '628157'),
            array('name' => trim('موسسه اعتباری کوثر'), 'card_number' => '505801'),
            array('name' => trim('بانک تجارت'), 'card_number' => '585983'),
            array('name' => trim('بانک شهر'), 'card_number' => '504706'),
            array('name' => trim('بانک رسالت'), 'card_number' => '504172'),
            array('name' => trim('بانک خاورمیانه'), 'card_number' => '585947'),
            array('name' => trim('آسان پرداخت'), "card_number" => '000000'),
            array('name' => trim('موسسه مالی و اعتباری نور'), 'card_number' => '507677'),
        );
        \Illuminate\Support\Facades\DB::table('banks')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
