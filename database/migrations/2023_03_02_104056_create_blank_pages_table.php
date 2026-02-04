<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlankPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blank_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('blank_page_type_id')->constrained('blank_page_types')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('link_url');
            $table->boolean('only_link');
            $table->text('excerpt');
            $table->text('body');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->text('meta_description');
            $table->text('meta_keywords');
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
        Schema::dropIfExists('blank_pages');
    }
}
