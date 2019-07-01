<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date_prediction')->nullable();
            $table->dateTime('end_date_actual')->nullable();
            $table->unsignedInteger('city_id')->nullable();//city _id
            $table->unsignedInteger('province_id')->nullable();//province id
            $table->unsignedInteger('media_id')->nullable();//title image
            $table->unsignedInteger('project_type_id')->nullable();//title image
            $table->integer('parent_id')->default(0);
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('building_projects');
    }
}
