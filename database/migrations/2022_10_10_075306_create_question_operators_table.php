<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_operators', function (Blueprint $table) {
            $table->id();
            $table->string('competency')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('lesson')->nullable();
            $table->string('reference')->nullable();
            $table->string('lesson_plan')->nullable();
            $table->string('processing_time')->nullable();
            $table->string('realization')->nullable();
            $table->string('total_time')->nullable();
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
        Schema::dropIfExists('question_operators');
    }
};
