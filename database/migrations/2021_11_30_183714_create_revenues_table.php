<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('revenue_types');
            $table->string('description');
            $table->float('value', 16, 2)->nullable();
            $table->date('receipt_at', $precision = 0)->nullable();
            $table->date('collection_initial_at', $precision = 0)->nullable();
            $table->date('collection_final_at', $precision = 0)->nullable();
            $table->text('referent');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('revenues');
    }
}
