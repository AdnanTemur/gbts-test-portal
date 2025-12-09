<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('version_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_version_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_section_id')->constrained()->onDelete('cascade');
            $table->integer('section_order')->comment('Order in which sections appear');
            $table->timestamps();
            
            $table->unique(['test_version_id', 'test_section_id']);
            $table->index(['test_version_id', 'section_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('version_sections');
    }
};
