<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1) جدول الأدوات الأساسي
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        // 2) جدول الربط بين الخبرات والأدوات (many-to-many)
        Schema::create('experience_tool', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_id')
                  ->constrained('experiences')
                  ->cascadeOnDelete();
            $table->foreignId('tool_id')
                  ->constrained('tools')
                  ->cascadeOnDelete();
            $table->timestamps();
        });

        // لاحقاً، يمكن إنشاء pivot آخر للمشاريع:
        // Schema::create('project_tool', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
        //     $table->foreignId('tool_id')->constrained('tools')->cascadeOnDelete();
        //     $table->timestamps();
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('experience_tool');
        Schema::dropIfExists('tools');
        // Schema::dropIfExists('project_tool');
    }
};
