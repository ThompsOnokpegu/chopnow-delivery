<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id')->nullable(); // Add sessionId field
            $table->unsignedBigInteger('menu_id');
            $table->integer('quantity');
            $table->timestamps();

            // Define foreign key constraints for menu_id
            $table->foreign('menu_id')->references('id')->on('menus');

            // Add a unique constraint for user_id and menu_id
            $table->unique(['user_id', 'menu_id']);

            // Define a foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
