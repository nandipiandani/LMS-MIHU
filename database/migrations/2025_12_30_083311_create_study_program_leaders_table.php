<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyProgramLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_program_leaders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('study_program_id')
          ->constrained()
          ->cascadeOnDelete();
    $table->string('name');
    $table->string('position');
    $table->string('photo')->nullable();
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
        Schema::dropIfExists('study_program_leaders');
    }
}
