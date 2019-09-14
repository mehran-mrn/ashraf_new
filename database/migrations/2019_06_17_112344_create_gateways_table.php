<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('bank_id');
            $table->string('account_number')->nullable();
            $table->string('account_sheba')->nullable();
            $table->string('card_number')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('status')->nullable();
            $table->integer('merchant')->nullable();
            $table->string('public_key')->nullable();
            $table->string('private_key')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->integer('terminal_id')->nullable();
            $table->string('logo')->nullable();
            $table->integer('logo_id')->nullable();
            $table->integer('online')->nullable();
            $table->integer('cart')->nullable();
            $table->integer('account')->nullable();
            $table->string('file_address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

//        DB::table('gateways')->insert(
//            array(
//                'title' => 'درگاه آنلاین',
//                'bank_id' => '35',
//                'account_number' => '0302470888002',
//                'account_sheba' => '000000000000302470888002',
//                'card_number' => '6037997130857253',
//                'bank_branch' => 'امام',
//                'status' => 'active',
//                'merchant' => '000000140329876',
//                'public_key' => 'RnszP6AYaaZCF4PoGnsCTQAOhAmMdYWZ',
//                'terminal_id' => '24042986',
//                'logo'=>'<i class="ibl64 ibl-bmi"></i>',
//                'online'=>'1'
//            )
//        );
//        DB::table('gateways')->insert(
//            array(
//                'title' => 'درگاه پرداخت',
//                'bank_id' => '17',
//                'account_number' => '4026505639',
//                'account_sheba' => '0000000000004026505639',
//                'card_number' => '6104337933280966',
//                'bank_branch' => 'امیر کبیر',
//                'status' => 'active',
//                'merchant' => '3013',
//                'password' => Hash::make('9542264'),
//                'logo'=>'<i class="ibl64 ibl-sb"></i>',
//                'cart'=>'1'
//
//            )
//        );
//        DB::table('gateways')->insert(
//            array(
//                'title' => 'درگاه آنلاین',
//                'bank_id' => '22',
//                'account_number' => '302910299901',
//                'account_sheba' => '000000000000302910299901',
//                'card_number' => '603799708788989',
//                'bank_branch' => 'کوروش',
//                'status' => 'active',
//                'terminal_id' => '69000443',
//                'merchant' => '693408839800106',
//                'logo'=>'<i class="ibl64 ibl-bsi"></i>',
//                'account'=>'1',
//                'cart'=>'1'
//            )
//        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateways');
    }
}
