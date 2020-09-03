<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->comment('user_id=student_id');
            $table->integer('student_roll')->nullable();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->foreign("student_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("class_id")->references("id")->on("student_classes")->onDelete('cascade');
            $table->foreign("year_id")->references("id")->on("student_years")->onDelete('cascade');
            $table->foreign("group_id")->references("id")->on("student_groups")->onDelete('cascade');
            $table->foreign("shift_id")->references("id")->on("student_shits")->onDelete('cascade');
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
        Schema::dropIfExists('student_registrations');
    }
}
