<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOmbudsmanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ombudsmen', function (Blueprint $table) {
            $table->string('protocol')->nullable();
            $table->text('answer');
            $table->enum('status', ['ANSWERD', 'PROCESSED', 'REJECTED', 'PENDING'])->default('PENDING');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
