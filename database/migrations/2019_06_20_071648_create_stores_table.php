<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->integer('icon_id')->nullable();
            $table->string('icon')->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('sort')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_discount_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->dateTime('expire_date');
            $table->integer('discount_persent');
            $table->integer('max_discount');
            $table->integer('count');
            $table->integer('usage_count');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_item_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('prefix')->nullable();
            $table->string('suffix')->nullable();
            $table->string('description')->nullable();
            $table->integer('category_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('properties')->nullable();
            $table->string('main_image')->nullable();
            $table->string('main_image_id')->nullable();
            $table->string('price')->default('0');
            $table->string('off')->default('0');
            $table->integer('ready')->default('1');
            $table->string('status')->default('active');
            $table->integer('website_id')->default(0);
            $table->string('model')->nullable()->unique();
            $table->string('code')->nullable()->unique();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('store_products');
            $table->integer('category_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('store_products');
            $table->integer('media_id')->nullable();
            $table->string('url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('store_products');
            $table->string('tag');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('store_products');
            $table->string('item_id');
            $table->string('value');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_gateways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('store_products');
            $table->integer('gateway_id');
            $table->string('type');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('store_products');
            $table->string('color_code')->nullable();
            $table->integer('count')->default(0);
            $table->string('price')->default(0);
            $table->integer('off')->default(0);
            $table->string('type')->default('p');
            $table->string('user_id')->default(0);
            $table->string('buy_number')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_inventory_sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('size');
            $table->string('price')->default(0);
            $table->integer('count')->default(0);
            $table->integer('off')->default(0);
            $table->integer('inventory_id')->default(0);
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('store_products');
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
        Schema::dropIfExists('stores');
    }
}
