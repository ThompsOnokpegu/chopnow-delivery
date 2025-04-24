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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['Meals', 'Sides', 'Drinks']);
            $table->string('description')->nullable();
            $table->decimal('regular_price', 8, 2);
            $table->decimal('sales_price', 8, 2)->nullable();
            $table->unsignedBigInteger('vendor_id'); // Vendor ID
            $table->enum('status', ['active', 'inactive']);
            $table->string('product_image')->nullable();
            $table->string('product_image_pid')->nullable(); // Cloudinary public ID

            // Add more menu-related fields as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
