<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->integer('discipline_id')->constrained('disciplines')->nullable();
            $table->string('file')->nullable();
            $table->integer('answers')->nullable();
            $table->integer('correct_answer')->nullable();
            $table->enum('type', ['A', 'P', 'E'])->default('A');//A=Ambos;P=Prova;E=Simulado
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
