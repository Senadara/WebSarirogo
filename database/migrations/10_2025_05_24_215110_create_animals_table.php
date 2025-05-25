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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cage_id')->constrained('cages');
            $table->foreignId('category_id')->constrained('categories');
            $table->date('entry_date');
            $table->date('expiry_date')->nullable();
            $table->decimal('weight', 6, 2)->nullable();
            $table->enum('status', ['Alive', 'Dead']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
