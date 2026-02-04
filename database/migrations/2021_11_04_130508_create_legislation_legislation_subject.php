<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegislationLegislationSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislation_legislation_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('legislation_id')->constrained('legislations');
            $table->foreignId('legislation_subject_id')->constrained('legislation_subjects');
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
        Schema::dropIfExists('legislation_legislation_subject');
    }
}
