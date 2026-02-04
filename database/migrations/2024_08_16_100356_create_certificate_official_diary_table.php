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
        Schema::create('certificate_official_diary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certificate_id')->constrained('certificates');
            $table->foreignId('official_diary_id')->constrained('official_diaries');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_official_diary');
    }
};
