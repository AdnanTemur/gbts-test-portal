<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_versions', function (Blueprint $table) {
            $table->id();
            $table->string('version_code')->unique(); // TEST-V001-20241208-143052
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('section_time_limit')->comment('Time limit in minutes per section');
            $table->integer('questions_per_section')->comment('Number of questions in each section');
            $table->integer('expected_candidates')->default(50);
            $table->integer('overlap_threshold')->default(20)->comment('Maximum acceptable overlap percentage');
            $table->integer('pass_threshold')->default(60)->comment('Pass percentage threshold');
            $table->enum('status', ['draft', 'active', 'completed', 'archived'])->default('draft');
            $table->boolean('shuffle_questions')->default(true);
            $table->boolean('shuffle_options')->default(true);
            $table->timestamps();
            
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_versions');
    }
};
