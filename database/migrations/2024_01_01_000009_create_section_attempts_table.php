<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_attempt_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_section_id')->constrained()->onDelete('cascade');
            $table->integer('section_order');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('time_taken')->nullable()->comment('Time taken in seconds');
            $table->decimal('score', 8, 2)->nullable();
            $table->integer('total_questions')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('incorrect_answers')->default(0);
            $table->integer('unanswered')->default(0);
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'timeout'])->default('not_started');
            $table->timestamps();
            
            $table->unique(['test_attempt_id', 'test_section_id']);
            $table->index(['test_attempt_id', 'section_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_attempts');
    }
};
