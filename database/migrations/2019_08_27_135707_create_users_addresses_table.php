<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('province_id');
            $table->integer('city_id');
            $table->mediumText('address');
            $table->string('receiver')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('status')->default('active');
            $table->boolean('default')->default(1);
            $table->string('zip_code')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
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
        Schema::dropIfExists('users_addresses');
    }
}
