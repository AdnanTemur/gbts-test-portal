<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('version_sections', function (Blueprint $table) {
            $table->integer('questions_per_section')->nullable()->after('section_order')
                ->comment('Per-section override; falls back to test_versions.questions_per_section if null');
        });

        // Backfilling existing rows from the parent test_version
        DB::statement('
            UPDATE version_sections vs
            JOIN test_versions tv ON tv.id = vs.test_version_id
            SET vs.questions_per_section = tv.questions_per_section
        ');
    }

    public function down(): void
    {
        Schema::table('version_sections', function (Blueprint $table) {
            $table->dropColumn('questions_per_section');
        });
    }
};