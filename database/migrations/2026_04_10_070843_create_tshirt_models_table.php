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
        Schema::create('tshirt_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('edition_id')
                  ->constrained('tshirt_editions')
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('design_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tshirt_models');
    }
};
