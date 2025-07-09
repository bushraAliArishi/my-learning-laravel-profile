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
        // 1) جدول المشاريع الرئيس
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        // 2) جدول الوسائط (صور وفيديو) لكل مشروع
        Schema::create('project_media', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();
            $table->string('media_url');
            $table->enum('media_type', ['image', 'video']);
            $table->timestamps();
        });

        // 3) جدول الوسوم (Tags) مع لون مخصص لكل وسم
        Schema::create('project_tags', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();
            $table->string('tag');
            // رمز اللون بصيغة HEX (مثال: "#1E40AF")
            $table->string('color_hex', 7)->default('#000000');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tags');
        Schema::dropIfExists('project_media');
        Schema::dropIfExists('projects');
    }
};
