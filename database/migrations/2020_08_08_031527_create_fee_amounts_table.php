<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_amounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fee_categorie_id');
            $table->unsignedBigInteger('class_id');
            $table->double('amount');
            $table->foreign("fee_categorie_id")->references("id")->on("fee_categories")->onDelete('cascade');
            $table->foreign("class_id")->references("id")->on("student_classes")->onDelete('cascade');
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
        Schema::dropIfExists('fee_amounts');
    }
}
