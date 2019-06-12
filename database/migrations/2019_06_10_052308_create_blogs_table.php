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
            $table->string('title');
            $table->string('slug');
            $table->longText('text');
            $table->string('description');
            $table->text('image');
            $table->dateTime('publish_time');
            $table->string('publish_status');
            $table->integer('user_id');
            $table->timestamps();
        });
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('blog_id');
            $table->string('tag');
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->integer('status')->default(10);
            $table->timestamps();
        });
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('blog_id');
            $table->integer('category_id');
            $table->integer('status')->default(10);
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
        Schema::dropIfExists('blog_tag');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('blog_category_rel');
    }
}
