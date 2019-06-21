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
            $table->string('logo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        $data = array(
            array('name' => trim('﻿بانک اقتصاد نوین'), 'card_number' => '627412','logo'=>'<i class="ibl64 ibl-en"></i>'),
            array('name' => trim('بانک انصار'), 'card_number' => '627381','logo'=>'<i class="ibl64 ibl-ansar"></i>'),
            array('name' => trim('بانک ایران زمین'), 'card_number' => '505785','logo'=>'<i class="ibl64 ibl-iz"></i>'),
            array('name' => trim('بانک پارسیان'), 'card_number' => '622106','logo'=>'<i class="ibl64 ibl-parsian"></i>'),
            array('name' => trim('بانک پارسیان'), 'card_number' => '639194','logo'=>'<i class="ibl64 ibl-parsian"></i>'),
            array('name' => trim('بانک پارسیان'), 'card_number' => '627884','logo'=>'<i class="ibl64 ibl-parsian"></i>'),
            array('name' => trim('بانک پاسارگاد'), 'card_number' => '639347','logo'=>'<i class="ibl64 ibl-bpi"></i>'),
            array('name' => trim('بانک پاسارگاد'), 'card_number' => '502229','logo'=>'<i class="ibl64 ibl-bpi"></i>'),
            array('name' => trim('بانک تات'), 'card_number' => '636214','logo'=>''),
            array('name' => trim('بانک تجارت'), 'card_number' => '627353','logo'=>'<i class="ibl64 ibl-tejarat"></i>'),
            array('name' => trim('بانک توسعه تعاون'), 'card_number' => '502908','logo'=>'<i class="ibl64 ibl-edbi"></i>'),
            array('name' => trim('بانک توسعه صادرات ایران'), 'card_number' => '627648','logo'=>'<i class="ibl64 ibl-edbi"></i>'),
            array('name' => trim('بانک توسعه صادرات ایران'), 'card_number' => '207177','logo'=>'<i class="ibl64 ibl-edbi"></i>'),
            array('name' => trim('بانک حکمت ایرانیان'), 'card_number' => '636949','logo'=>'<i class="ibl64 ibl-hi"></i>'),
            array('name' => trim('بانک دی'), 'card_number' => '502938','logo'=>'<i class="ibl64 ibl-day"></i>'),
            array('name' => trim('بانک رفاه کارگران'), 'card_number' => '589463','logo'=>'<i class="ibl64 ibl-rb"></i>'),
            array('name' => trim('بانک سامان'), 'card_number' => '621986','logo'=>'<i class="ibl64 ibl-sb"></i>'),
            array('name' => trim('بانک سپه'), 'card_number' => '589210','logo'=>'<i class="ibl64 ibl-sepah"></i>'),
            array('name' => trim('بانک سرمایه'), 'card_number' => '639607','logo'=>'<i class="ibl64 ibl-sarmayeh"></i>'),
            array('name' => trim('بانک سینا'), 'card_number' => '639346','logo'=>'<i class="ibl64 ibl-sina"></i>'),
            array('name' => trim('بانک شهر'), 'card_number' => '502806','logo'=>'<i class="ibl64 ibl-shahr"></i>'),
            array('name' => trim('بانک صادرات ایران'), 'card_number' => '603769','logo'=>'<i class="ibl64 ibl-bsi"></i>'),
            array('name' => trim('بانک صنعت و معدن'), 'card_number' => '627961','logo'=>'<i class="ibl64 ibl-bim"></i>'),
            array('name' => trim('بانک قرض الحسنه مهر ایران'), 'card_number' => '606373','logo'=>''),
            array('name' => trim('بانک قوامین'), 'card_number' => '639599','logo'=>'<i class="ibl64 ibl-ghbi"></i>'),
            array('name' => trim('بانک کارآفرین'), 'card_number' => '627488','logo'=>'<i class="ibl64 ibl-kar"></i>'),
            array('name' => trim('بانک کارآفرین'), 'card_number' => '502910','logo'=>'<i class="ibl64 ibl-kar"></i>'),
            array('name' => trim('بانک کشاورزی'), 'card_number' => '603770','logo'=>'<i class="ibl64 ibl-bki"></i>'),
            array('name' => trim('بانک کشاورزی'), 'card_number' => '639217','logo'=>'<i class="ibl64 ibl-bki"></i>'),
            array('name' => trim('بانک گردشگری'), 'card_number' => '505416','logo'=>'<i class="ibl64 ibl-tourism"></i>'),
            array('name' => trim('بانک مرکزی'), 'card_number' => '636795','logo'=>''),
            array('name' => trim('بانک مسکن'), 'card_number' => '628023','logo'=>'<i class="ibl64 ibl-maskan"></i>'),
            array('name' => trim('بانک ملت'), 'card_number' => '610433','logo'=>'<i class="ibl64 ibl-mellat animated pulse"></i>'),
            array('name' => trim('بانک ملت'), 'card_number' => '991975','logo'=>'<i class="ibl64 ibl-mellat animated pulse"></i>'),
            array('name' => trim('بانک ملی ایران'), 'card_number' => '603799','logo'=>'<i class="ibl64 ibl-bmi"></i>'),
            array('name' => trim('بانک مهر اقتصاد'), 'card_number' => '639370','logo'=>''),
            array('name' => trim('پست بانک ایران'), 'card_number' => '627760','logo'=>'<i class="ibl64 ibl-post"></i>'),
            array('name' => trim('موسسه اعتباری توسعه'), 'card_number' => '628157','logo'=>'<i class="ibl64 ibl-tt"></i>'),
            array('name' => trim('موسسه اعتباری کوثر'), 'card_number' => '505801','logo'=>''),
            array('name' => trim('بانک تجارت'), 'card_number' => '585983','logo'=>'<i class="ibl64 ibl-tejarat"></i>'),
            array('name' => trim('بانک شهر'), 'card_number' => '504706','logo'=>'<i class="ibl64 ibl-shahr"></i>'),
            array('name' => trim('بانک رسالت'), 'card_number' => '504172','logo'=>''),
            array('name' => trim('بانک خاورمیانه'), 'card_number' => '585947','logo'=>'<i class="ibl64 ibl-me"></i>'),
            array('name' => trim('آسان پرداخت'), "card_number" => '000000','logo'=>''),
            array('name' => trim('موسسه مالی و اعتباری نور'), 'card_number' => '507677','logo'=>''),
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
