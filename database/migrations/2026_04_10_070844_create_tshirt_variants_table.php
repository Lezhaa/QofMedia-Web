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
        Schema::create('tshirt_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')
                  ->constrained('tshirt_models')
                  ->onDelete('cascade');
            $table->enum('size', ['S', 'M', 'L', 'XL', 'XXL']);
            $table->string('color');
            $table->enum('sleeve_type', ['pendek', 'panjang']);
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedBigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tshirt_variants');
    }
};
