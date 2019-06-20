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
            $table->string('description')->nullable();
            $table->integer('icon_id')->nullable();
            $table->string('icon')->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('sort')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('store_categories')->insert(
            array(
                'title' => 'تاج گل',
                'description' => 'سفارش تاج گل',
            )
        );
        DB::table('store_categories')->insert(
            array(
                'title' => 'دسته گل',
                'description' => 'دسته گل',
            )
        );

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
            $table->string('prefix');
            $table->string('suffix');
            $table->string('description');
            $table->integer('category_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('store_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->text('description');
            $table->integer('price');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->integer('category_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->integer('media_id');
            $table->string('url');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('tag');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('store_product_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('item_id');
            $table->string('value');
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
