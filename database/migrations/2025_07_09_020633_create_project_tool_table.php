<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_tool', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();
            $table
                ->foreignId('tool_id')
                ->constrained('tools')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_tool');
    }
};
