<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('studio_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['foto', 'video', 'foto & video']);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price');
            $table->string('duration')->nullable();
            $table->json('facilities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studio_packages');
    }
};
