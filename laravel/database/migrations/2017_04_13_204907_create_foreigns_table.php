<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('外来人员姓名');
            $table->char('tel')->comment('手机');
            $table->tinyInteger('status')->comment('是否已离开');
            $table->string('desc')->comment('外来缘由');
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
        Schema::dropIfExists('foreigns');
    }
}
