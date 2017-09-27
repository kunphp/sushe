<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('build_id')->comment('宿舍楼');
            $table->string('desc')->comment('设备保修原因');
            $table->tinyInteger('status')->comment('状态是否维修完成');
            $table->string('dorm_id')->comment('宿舍');
            $table->string('name')->comment('处理人')->nullable();
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
        Schema::dropIfExists('repairs');
    }
}
