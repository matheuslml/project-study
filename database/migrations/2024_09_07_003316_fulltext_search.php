<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('official_diaries', function (Blueprint $table) {
            $table->string('edition')->fulltext()->change();
            $table->text('description')->nullable()->fulltext()->change();
            $table->longText('content')->nullable()->fulltext()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('official_diaries', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }
};
