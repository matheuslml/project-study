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
        Schema::create('acts', function (Blueprint $table) {
            $table->id();
            $table->integer('official_diary_id')->constrained('official_diaries')->nullable();
            $table->integer('act_topic_id')->constrained('act_topics')->nullable();
            $table->enum('act_type', ['OFFICIAL', 'NEWS', 'OTHER'])->default('OFFICIAL');
            $table->string('title')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->integer('order');
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
        Schema::dropIfExists('acts');
    }
};
