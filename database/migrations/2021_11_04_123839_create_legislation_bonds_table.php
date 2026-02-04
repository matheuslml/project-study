<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegislationBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislation_bonds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('base_id')->constrained('legislations');
            $table->foreignId('vinculo_id')->constrained('legislations');
            $table->enum('status', ['REVOGADO', 'ALTERADO', 'VINCULADO'])->default('VINCULADO');
            $table->boolean('active');
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
        Schema::dropIfExists('legislation_bonds');
    }
}
