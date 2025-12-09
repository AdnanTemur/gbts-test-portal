<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_version_id')->constrained()->onDelete('cascade');
            $table->string('attempt_token')->unique()->index();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('time_taken')->nullable()->comment('Total time taken in seconds');
            $table->decimal('score', 8, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->integer('total_questions')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('incorrect_answers')->default(0);
            $table->integer('unanswered')->default(0);
            $table->integer('current_section_index')->default(0)->comment('Which section candidate is currently on');
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'timeout'])->default('not_started');
            $table->boolean('passed')->nullable();
            $table->timestamps();
            
            $table->index(['candidate_id', 'status']);
            $table->index(['test_version_id', 'status']);
            $table->index('completed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};
