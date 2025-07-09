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
        // 1) جدول الخبرات الرئيس
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('company');
            $table->string('period');
            $table->text('details');
            $table->timestamps();
        });

        // 2) جدول المهارات المرتبطة بكل خبرة
        Schema::create('experience_skills', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('experience_id')
                ->constrained('experiences')
                ->cascadeOnDelete();
            $table->string('skill_name');
            $table->timestamps();
        });

        // 3) جدول الإنجازات الرئيسية
        Schema::create('experience_achievements', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('experience_id')
                ->constrained('experiences')
                ->cascadeOnDelete();
            $table->text('description');
            $table->timestamps();
        });
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
