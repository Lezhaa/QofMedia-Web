<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel members
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nickname');
            $table->string('social_platform')->nullable()->comment('instagram, twitter, linkedin, github, tiktok, facebook, youtube');
            $table->string('social_username')->nullable()->comment('username atau link lengkap');
            $table->string('photo')->nullable();
            $table->string('position')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel pivot division_member
        Schema::create('division_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->onDelete('cascade');
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['division_id', 'member_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('division_member');
        Schema::dropIfExists('members');
    }
};