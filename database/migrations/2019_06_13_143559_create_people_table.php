<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('image_id')->nullable();
            $table->string('name');
            $table->string('family');
            $table->string('known')->nullable();
            $table->string('en_name')->nullable();
            $table->string('en_family')->nullable();
            $table->string('en_known')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('national_code')->unique();
            $table->string('sh_code')->unique();
            $table->boolean('gender'); // 0=> male 1=>female
            $table->boolean('validate')->default('0'); // 0=> not  1=>validate
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
        Schema::dropIfExists('people');
    }
}
