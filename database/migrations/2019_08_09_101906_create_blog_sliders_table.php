<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_large')->nullable();
            $table->string('image_thumbnail')->nullable();
            $table->mediumText("text_1")->nullable();
            $table->string('text_1_dir')->nullable();
            $table->mediumText("text_2")->nullable();
            $table->string('text_2_dir')->nullable();
            $table->mediumText("text_3")->nullable();
            $table->string('text_3_dir')->nullable();
            $table->string("btn_text")->nullable();
            $table->string('btn_dir')->nullable();
            $table->string('btn_link')->nullable();
            $table->boolean("disable")->default(0);
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
        Schema::dropIfExists('blog_sliders');
    }
}
