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
        Schema::create('apparel_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                  ->constrained('apparel_categories')
                  ->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->string('image')->nullable();
            $table->enum('type', ['kaos', 'other'])->default('other');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apparel_products');
    }
};
