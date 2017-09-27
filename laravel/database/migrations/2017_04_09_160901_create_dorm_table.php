<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dorm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dorm_name')->comment('宿舍名');
            $table->tinyInteger('bulid')->comment('宿舍楼');
            $table->tinyInteger('num')->comment('可住人数');
            $table->tinyInteger('status')->comment('状态');
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
        Schema::dropIfExists('dorm');
    }
}
