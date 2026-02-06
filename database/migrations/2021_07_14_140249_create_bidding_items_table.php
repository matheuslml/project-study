<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiddingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidding_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidding_id')->constrained('biddings');
            $table->foreignId('person_id')->nullable()->constrained('people');
            $table->integer('quantity')->nullable();
            $table->string('name');
            $table->decimal('value', $precision = 8, $scale = 2)->nullable();
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
        Schema::dropIfExists('bidding_items');
    }
}
