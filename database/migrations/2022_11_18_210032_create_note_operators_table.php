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
        Schema::create('note_operators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competency_id');
            $table->longText('note');
            $table->timestamps();

            $table->foreign('competency_id')->references('id')->on('competencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_operators');
    }
};
