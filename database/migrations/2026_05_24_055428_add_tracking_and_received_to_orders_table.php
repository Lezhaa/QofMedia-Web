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
            $table->string('tracking_number')->nullable()->after('catatan_admin');
            $table->timestamp('received_at')->nullable()->after('paid_at');
            $table->timestamp('packing_at')->nullable()->after('paid_at');
            $table->timestamp('shipped_at')->nullable()->after('packing_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['tracking_number', 'received_at', 'packing_at', 'shipped_at']);
        });
    }
};
