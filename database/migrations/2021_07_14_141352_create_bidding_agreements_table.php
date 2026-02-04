<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiddingAgreementsTable extends Migration
{
    /**
     * Run the migrations.d
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidding_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_id')->constrained('agreement_origins');
            $table->foreignId('type_id')->constrained('agreement_types');
            $table->foreignId('situation_id')->constrained('agreement_situations');
            $table->foreignId('bidding_id')->constrained('biddings');
            $table->string('title');
            $table->string('slug');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->string('process')->nullable();
            $table->string('contract')->nullable();
            $table->string('document')->nullable();
            $table->foreignId('document_type_id')->nullable()->constrained('document_types');
            $table->string('name')->nullable();
            $table->decimal('value', $precision = 15, $scale = 2)->nullable();
            $table->string('supervisor')->nullable();
            $table->string('manager')->nullable();
            $table->date('date_signature', $precision = 0)->nullable();
            $table->date('date_validity_init', $precision = 0)->nullable();
            $table->date('date_validity_end', $precision = 0)->nullable();
            $table->date('date_diary', $precision = 0)->nullable();
            $table->text('object')->nullable();
            $table->text('legal_reasoning')->nullable();
            $table->text('observation')->nullable();
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
        Schema::dropIfExists('bidding_agreements');
    }
}
