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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('sku', 50)->unique()->nullable();
            $table->string('brand', 100)->nullable();
            
            // Foreign Keys (Normalized)
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses');
            
            // Item Classification
            $table->enum('type', ['supplies', 'harvest'])->default('supplies');
            $table->enum('item_type', ['consumable', 'non_consumable', 'fixed_asset'])->default('consumable');
            
            // Stock Management
            $table->integer('stock')->default(0);
            $table->integer('initial_stock')->default(0);
            $table->string('unit', 20)->default('pcs');
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('min_stock')->default(10);
            $table->decimal('daily_usage_estimate', 10, 2)->nullable();
            
            // Dates
            $table->date('entry_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->timestamp('last_restock_date')->nullable();
            
            // Media & Status
            $table->string('image')->nullable();
            $table->enum('status', ['available', 'low_stock', 'out_of_stock'])->default('available');
            
            // Notes
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
