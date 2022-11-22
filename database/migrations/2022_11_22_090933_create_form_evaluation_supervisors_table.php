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
        Schema::create('form_evaluation_supervisors', function (Blueprint $table) {
            $table->id();
            $table->longtext('tools');
            $table->longText('unit');
            $table->longText('test_material');
            $table->longText('competence_test');
            $table->string('result');
            $table->longText('description');
            $table->string('average_minimum_value');
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
        Schema::dropIfExists('form_evaluation_supervisors');
    }
};
