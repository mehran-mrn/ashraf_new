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
            $table->integer('bank_id');
            $table->integer('account_number')->nullable();
            $table->integer('account_sheba')->nullable();
            $table->string('card_number')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('status')->nullable();
            $table->integer('merchant')->nullable();
            $table->text('public_key')->nullable();
            $table->text('private_key')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->integer('terminal_id')->nullable();
            $table->text('logo')->nullable();
            $table->integer('logo_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        DB::table('gateways')->insert(
            array(
                'bank_id' => '35',
                'account_number' => '0302470888002',
                'account_sheba' => '000000000000302470888002',
                'card_number' => '6037997130857253',
                'bank_branch' => 'امام',
                'status' => 'active',
                'merchant' => '000000140329876',
                'public_key' => 'RnszP6AYaaZCF4PoGnsCTQAOhAmMdYWZ',
                'terminal_id' => '24042986',
            )
        );
        DB::table('gateways')->insert(
            array(
                'bank_id' => '17',
                'account_number' => '4026505639',
                'account_sheba' => '0000000000004026505639',
                'card_number' => '6104337933280966',
                'bank_branch' => 'امیر کبیر',
                'status' => 'active',
                'merchant' => '3013',
                'password' => Hash::make('9542264'),
            )
        );
        DB::table('gateways')->insert(
            array(
                'bank_id' => '22',
                'account_number' => '302910299901',
                'account_sheba' => '000000000000302910299901',
                'card_number' => '603799708788989',
                'bank_branch' => 'کوروش',
                'status' => 'active',
                'terminal_id' => '69000443',
                'merchant' => '693408839800106',
            )
        );
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
