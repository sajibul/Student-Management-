<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscoutStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discout_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_student_id');
            $table->unsignedBigInteger('fee_category_id')->nullable();
            $table->double('discount')->nullable();
            $table->foreign("registration_student_id")->references("id")->on("student_registrations")->onDelete('cascade');
            $table->foreign("fee_category_id")->references("id")->on("fee_categories")->onDelete('cascade');
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
        Schema::dropIfExists('discout_students');
    }
}
