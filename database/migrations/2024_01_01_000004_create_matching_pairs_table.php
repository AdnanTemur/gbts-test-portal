<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matching_pairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('column_a_text'); // Left side text
            $table->string('column_b_text'); // Right side text (correct match)
            $table->string('column_b_key'); // Key for matching (A, B, C, D)
            $table->integer('pair_order')->default(0); // 1, 2, 3, 4
            $table->timestamps();
            
            $table->index(['question_id', 'pair_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matching_pairs');
    }
};
