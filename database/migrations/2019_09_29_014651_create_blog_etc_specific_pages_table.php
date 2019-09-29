<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogEtcSpecificPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('blog_etc_specific_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string("category_name")->nullable();
            $table->string("slug")->unique();
            $table->mediumText("category_description")->nullable();
            $table->string("lang")->default('fa');

            $table->unsignedInteger("created_by")->nullable()->index()->comment("user id");

            $table->boolean("last_post")->default(0);
            $table->boolean("articles")->default(0);

            $table->timestamps();
        });


        Schema::create('blog_etc_page_specific_pages', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger("blog_etc_post_id")->index();
            $table->foreign('blog_etc_post_id')->references('id')->on('blog_etc_posts')->onDelete("cascade");

            $table->unsignedInteger("blog_etc_page_specific_page_id")->index();
            $table->foreign('blog_etc_page_specific_page_id')->references('id')->on('blog_etc_specific_pages')->onDelete("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_etc_specific_pages');
    }
}
