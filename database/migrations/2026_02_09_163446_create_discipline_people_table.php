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
        Schema::create('discipline_people', function (Blueprint $table) {
            $table->id();
            $table->integer('discipline_id')->constrained('disciplines')->nullable();
            $table->integer('person_id')->constrained('people')->nullable();
            $table->date('exam_date', $precision = 0)->nullable();
            $table->date('started_at', $precision = 0)->nullable();
            $table->date('finished_at', $precision = 0)->nullable();
            $table->integer('score')->nullable();
            $table->integer('exam_nr')->nullable();
            $table->string('registration')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipline_people');
    }
};
