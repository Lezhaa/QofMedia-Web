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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('total_price')->default(0)->after('qty');
            $table->string('payment_method')->nullable()->after('status');
            $table->string('payment_token')->nullable()->after('payment_method');
            $table->string('payment_proof')->nullable()->after('payment_token');
            $table->text('payment_message')->nullable()->after('payment_proof');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['total_price', 'payment_method', 'payment_token', 'payment_proof', 'payment_message']);
        });
    }
};
