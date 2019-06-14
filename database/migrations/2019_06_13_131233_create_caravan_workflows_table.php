<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaravanWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caravan_workflows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('caravan_id');
            $table->integer('status')->default('0');
            // 0 custom-note | 1 start | 2 pre-register | 3 submit | 4 reject | 5 entrance | 6 single-exit | 7 caravan-exit | 8 finish-and-archive | 9 fully-canceled
            $table->string('small_description')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('date')->nullable();
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
        Schema::dropIfExists('caravan_workflows');
    }
}
