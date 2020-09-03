<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->comment('user_id=student_id');
            $table->integer('student_roll')->nullable();
            $table->integer('id_no')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('year_id')->nullable();
            $table->unsignedBigInteger('assign_subjects_id')->nullable();
            $table->unsignedBigInteger('exam_type_id')->nullable();
            $table->double('marks')->nullable();
            $table->foreign("student_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("class_id")->references("id")->on("student_classes")->onDelete('cascade');
            $table->foreign("year_id")->references("id")->on("student_years")->onDelete('cascade');
            $table->foreign("assign_subjects_id")->references("id")->on("assign_subjects")->onDelete('cascade');
            $table->foreign("exam_type_id")->references("id")->on("exam_types")->onDelete('cascade');
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
        Schema::dropIfExists('student_marks');
    }
}
