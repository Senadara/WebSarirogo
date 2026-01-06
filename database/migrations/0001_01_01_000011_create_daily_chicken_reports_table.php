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
        Schema::create('daily_chicken_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cage_id')->constrained('cages')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('report_date');
            
            // Population
            $table->integer('population_initial')->default(0);
            $table->integer('population_alive')->default(0);
            $table->integer('population_productive')->default(0);
            $table->integer('population_sick')->default(0);
            $table->integer('population_culled')->default(0);
            
            // Egg Production
            $table->integer('eggs_produced')->default(0);
            $table->decimal('eggs_weight_total', 10, 2)->default(0);
            $table->decimal('eggs_weight_avg', 6, 2)->nullable();
            
            // Feed
            $table->decimal('feed_consumed', 10, 2)->default(0);
            
            // Mortality
            $table->integer('mortality_count')->default(0);
            $table->string('mortality_cause')->nullable();
            
            // Pre-calculated Metrics
            $table->decimal('fcr', 6, 3)->nullable();
            $table->decimal('hdp', 6, 2)->nullable();
            $table->decimal('hhep', 6, 2)->nullable();
            
            // Activity & Media
            $table->string('activity_type')->nullable();
            $table->string('image')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            $table->unique(['cage_id', 'report_date']);
            $table->index('report_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_chicken_reports');
    }
};
