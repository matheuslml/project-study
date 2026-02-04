<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectHiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_hires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modality_id')->constrained('direct_hire_modalities');
            $table->foreignId('situation_id')->constrained('direct_hire_situations');
            $table->string('title');
            $table->string('slug');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->boolean('login');
            $table->string('bidding')->nullable();//número da licitação
            $table->string('notice')->nullable();//edital
            $table->string('process')->nullable();
            $table->decimal('value_min', $precision = 15, $scale = 2)->nullable();
            $table->decimal('value_max', $precision = 15, $scale = 2)->nullable();
            $table->dateTime('published_at')->nullable();
            $table->dateTime('realized_at')->nullable();
            $table->string('local')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direct_hires');
    }
}
