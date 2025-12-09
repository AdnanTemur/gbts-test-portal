<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('cnic')->unique()->index();
            $table->string('name');
            $table->string('father_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('photo')->nullable(); // Path to candidate photo
            $table->timestamps();
            
            $table->index(['cnic', 'phone']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
