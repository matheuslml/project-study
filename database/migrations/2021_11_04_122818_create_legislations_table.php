<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegislationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('legislation_categories');
            $table->foreignId('situation_id')->constrained('legislation_situations');
            $table->string('ementa');
            $table->integer('number');
            $table->string('number_complement');
            $table->date('date', $precision = 0)->nullable();
            $table->date('initial_term', $precision = 0)->nullable();
            $table->date('final_term', $precision = 0)->nullable();
            $table->text('information');
            $table->text('excerpt');
            $table->text('body');
            $table->text('meta_description');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
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
        Schema::dropIfExists('legislations');
    }
}
