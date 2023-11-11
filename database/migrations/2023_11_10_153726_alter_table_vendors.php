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
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('business_type')->nullable()->default(null);
            $table->decimal('delivery_fee')->nullable()->default(null);
            $table->integer('preparation_time')->nullable()->default(null);
            $table->boolean('featured')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn('business_type');
            $table->dropColumn('delivery_fee');
            $table->dropColumn('preparation_time');
            $table->dropColumn('featured');
        });
    }
};
