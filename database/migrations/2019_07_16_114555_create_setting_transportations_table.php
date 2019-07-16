<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTransportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_transportations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->integer('time')->default('0');
            $table->string('status')->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('setting_transportation_cost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('t_id');
            $table->integer('c_id');
            $table->string('cost')->default(0);
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
        Schema::dropIfExists('setting_transportations');
    }
}
