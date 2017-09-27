<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->comment('学生')->nullable();
            $table->integer('type')->comment('违纪/表扬')->nullable();
            $table->string('reason')->comment('原因');
            $table->integer('dorm_id')->comment('宿舍')->nullable();
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
        Schema::dropIfExists('disciplines');
    }
}
