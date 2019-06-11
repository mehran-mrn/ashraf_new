<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->integer('status')->default(10);
            $table->timestamps();
        });
        Schema::create('blogs_category_rel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('blog_id');
            $table->integer('category_id');
            $table->integer('status');
            $table->timestamps();
        });

        DB::table('categories')->insert(
            array(
                'title' => 'علمی',
                'status' => '10',
            )
        );
        DB::table('categories')->insert(
            array(
                'title' => 'فناوری',
                'status' => '10',
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
        Schema::dropIfExists('blogs');
    }
}
