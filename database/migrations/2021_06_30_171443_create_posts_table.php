<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_post_id')->constrained('type_posts');
            $table->foreignId('user_id')->constrained('users');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('order')->nullable();
            $table->string('link')->nullable();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
