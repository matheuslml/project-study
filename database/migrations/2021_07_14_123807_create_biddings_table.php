<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biddings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modality_id')->constrained('bidding_modalities');
            $table->foreignId('situation_id')->constrained('bidding_situations');
            $table->string('title');
            $table->string('slug');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->boolean('login');
            $table->string('bidding')->nullable();
            $table->string('notice')->nullable();
            $table->string('process')->nullable();
            $table->float('value_min', 16, 2)->nullable();
            $table->float('value_max', 16, 2)->nullable();
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
        Schema::dropIfExists('biddings');
    }
}
