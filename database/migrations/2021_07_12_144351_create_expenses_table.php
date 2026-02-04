<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_expense_id')->constrained('type_expenses');
            $table->foreignId('user_id')->constrained('users');
            $table->string('register');
            $table->string('title')->nullable();
            $table->text('notes')->nullable();
            $table->string('slug')->nullable();
            $table->string('source')->nullable();
            $table->float('current_balance', 16, 2)->nullable();
            $table->float('blocked_balance', 16, 2)->nullable();
            $table->float('used_balance', 16, 2)->nullable();
            $table->float('available_balance', 16, 2)->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
