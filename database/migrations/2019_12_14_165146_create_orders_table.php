<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('count')->default(0);
            $table->integer('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('users_addresses');
            $table->integer('transportation_id')->nullable();
            $table->foreign('transportation_id')->references('id')->on('setting_transportations');
            $table->integer('payment')->nullable();
            $table->string('price')->default(0);
            $table->string('tax')->default(0);
            $table->string('discount')->default(0);
            $table->string('final_price')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('orders_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('product_id')->default(0);
            $table->foreign('product_id')->references('id')->on('store_products');
            $table->integer('count')->nullable();
            $table->string('price')->default(0);
            $table->string('final_price')->default(0);
            $table->string('discount')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
