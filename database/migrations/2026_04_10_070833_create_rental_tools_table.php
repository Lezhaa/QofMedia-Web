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
        Schema::create('rental_tools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['Kamera', 'Video', 'Audio', 'Lighting', 'Tripod','Aksesoris']);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price_per_day');
            $table->unsignedInteger('stock')->default(0);
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_tools');
    }
};
