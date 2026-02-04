<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOmbudsmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ombudsmen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_request_id')->constrained('type_requests');
            $table->foreignId('access_id')->constrained('type_accesses');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('content');
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
        Schema::dropIfExists('ombudsmen');
    }
}
