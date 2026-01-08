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
        Schema::create('cages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('cage_type', 50)->nullable();
            $table->string('location')->nullable();
            $table->string('chicken_type', 50)->default('Layer')->comment('Broiler/Layer');
            $table->integer('capacity')->default(0);
            
            // Population tracking
            $table->integer('initial_population')->default(0);
            $table->integer('current_population')->default(0);
            
            // Age tracking
            $table->integer('age_days')->default(0);
            $table->enum('phase', ['starter', 'grower', 'production', 'culled'])->default('starter');
            
            // Dates
            $table->date('installed_date')->nullable();
            $table->date('chick_in_date')->nullable();
            
            // Media & Status
            $table->string('photo')->nullable();
            $table->enum('status', ['active', 'cleaning', 'empty', 'inactive'])->default('active');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cages');
    }
};
