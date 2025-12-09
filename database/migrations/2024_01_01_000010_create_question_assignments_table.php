<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_attempt_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_attempt_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->integer('display_order');
            $table->timestamps();
            
            $table->unique(['test_attempt_id', 'question_id']);
            $table->index(['section_attempt_id', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_assignments');
    }
};
