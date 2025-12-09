<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_section_id')->constrained()->onDelete('cascade');
            $table->enum('question_type', ['mcq', 'true_false', 'matching'])->default('mcq');
            $table->text('question_text');
            $table->string('question_image')->nullable(); // For non-verbal questions
            $table->enum('difficulty_level', ['easy', 'medium', 'hard'])->default('medium');
            $table->integer('marks')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['test_section_id', 'question_type']);
            $table->index(['test_section_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
