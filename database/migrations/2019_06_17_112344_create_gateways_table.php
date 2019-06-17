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
            $table->integer('merchent')->nullable();
            $table->text('public_key')->nullable();
            $table->integer('terminal_id')->nullable();
            $table->text('logo')->nullable();
            $table->integer('logo_id')->nullable();
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
        Schema::dropIfExists('gateways');
    }
}
