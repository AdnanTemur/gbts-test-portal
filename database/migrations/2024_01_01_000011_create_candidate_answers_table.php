<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidate_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_attempt_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_attempt_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('selected_option_id')->nullable()->constrained('question_options')->onDelete('set null');
            $table->json('matching_answers')->nullable()->comment('For matching questions: {1: "C", 2: "A", 3: "B", 4: "D"}');
            $table->boolean('is_correct')->default(false);
            $table->integer('time_spent')->nullable()->comment('Time spent on this question in seconds');
            $table->timestamps();
            
            $table->unique(['test_attempt_id', 'question_id']);
            $table->index(['section_attempt_id', 'is_correct']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_answers');
    }
};
