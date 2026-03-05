<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('test_versions', function (Blueprint $table) {
            $table->integer('questions_per_section')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('test_versions', function (Blueprint $table) {
            $table->integer('questions_per_section')->nullable(false)->change();
        });
    }
};