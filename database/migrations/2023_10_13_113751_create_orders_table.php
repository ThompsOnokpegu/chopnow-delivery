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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('recipient_address');
            $table->string('recipient_phone');
            $table->string('recipient_name');
            $table->decimal('discount', 10, 2);
            $table->string('payment_method');
            $table->enum('order_status', ['Processing', 'Enroute', 'Delivered', 'Canceled']);
            // Add more order-related fields as needed
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
