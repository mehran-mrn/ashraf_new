<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->integer('code_phone')->nullable();
            $table->dateTime('code_phone_send')->nullable();
            $table->integer('code_email')->nullable();
            $table->dateTime('code_email_send')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('disabled')->nullable();
            $table->integer('last_modifier')->nullable()->unsigned();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'admin',
                'email' => 'name@domain.com',
                'password' => '$2y$10$ZhxwMNcm5SiNl9PAMCGZUO.B9KwDVzyKmYGYkBF5YHi4FuRa2Vviq',
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
        Schema::dropIfExists('users');
    }
}
