<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_name')->comment('学生姓名')->nullable();
            $table->string('num')->comment('学号')->nullable();
            $table->string('sex')->comment('性别')->nullable();
            $table->tinyInteger('academy')->comment('学院');
            $table->smallInteger('major_id')->comment('专业');
            $table->smallInteger('dorm_id')->comment('宿舍');
            $table->tinyInteger('build_id')->comment('宿舍楼');
            $table->string('tel')->comment('电话');
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
        Schema::dropIfExists('students');
    }
}
