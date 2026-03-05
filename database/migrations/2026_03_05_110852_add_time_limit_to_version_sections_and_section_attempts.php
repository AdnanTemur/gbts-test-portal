<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Per-section time limit on the pivot
        Schema::table('version_sections', function (Blueprint $table) {
            $table->integer('time_limit')->nullable()->after('questions_per_section')
                ->comment('Per-section time limit in minutes; falls back to test_versions.section_time_limit if null');
        });

        // Stamp resolved time limit on each section attempt (self-contained, like total_questions)
        Schema::table('section_attempts', function (Blueprint $table) {
            $table->integer('time_limit')->nullable()->after('section_order')
                ->comment('Resolved time limit in minutes at the time the attempt was created');
        });

        // Make test_versions.section_time_limit nullable (now superseded by per-section pivot)
        Schema::table('test_versions', function (Blueprint $table) {
            $table->integer('section_time_limit')->nullable()->change();
        });


        // Backfill pivot from version default
        DB::statement('
            UPDATE version_sections vs
            JOIN test_versions tv ON tv.id = vs.test_version_id
            SET vs.time_limit = tv.section_time_limit
        ');
    }

    public function down(): void
    {
        Schema::table('version_sections', function (Blueprint $table) {
            $table->dropColumn('time_limit');
        });
        Schema::table('section_attempts', function (Blueprint $table) {
            $table->dropColumn('time_limit');
        });

        Schema::table('test_versions', function (Blueprint $table) {
            $table->integer('section_time_limit')->nullable(false)->change();
        });
    }
};