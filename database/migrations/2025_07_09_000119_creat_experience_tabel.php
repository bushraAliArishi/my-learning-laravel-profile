<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1) Main experiences table
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('company');
            $table->string('period');              // ← Added period column
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('details');
            $table->timestamps();
        });

        // 2) experience_skills pivot
        Schema::create('experience_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_id')
                ->constrained('experiences')
                ->cascadeOnDelete();
            $table->string('skill_name');
            $table->timestamps();
        });

        // 3) experience_achievements pivot
        Schema::create('experience_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_id')
                ->constrained('experiences')
                ->cascadeOnDelete();
            $table->text('description');
            $table->timestamps();
        });

        // NOTE: the experience_tool pivot table should be in its own migration,
        // so we don't recreate it here and avoid duplicate-table errors.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_achievements');
        Schema::dropIfExists('experience_skills');
        Schema::dropIfExists('experiences');
    }
};
