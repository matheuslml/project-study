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
        Schema::create('official_diaries', function (Blueprint $table) {
            $table->id();
            $table->string('edition');
            $table->boolean('extra_edition')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['FILE', 'ACTS'])->default('ACTS');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_diaries');
    }
};
