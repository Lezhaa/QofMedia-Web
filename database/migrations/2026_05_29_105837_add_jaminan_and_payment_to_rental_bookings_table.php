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
        Schema::table('rental_bookings', function (Blueprint $table) {
            // Bukti transfer DP/pembayaran
            $table->string('bukti_transfer')->nullable()->after('catatan_user');
 
            // Jenis jaminan yang akan dibawa saat pengambilan
            $table->enum('jenis_jaminan', ['ktp', 'kk', 'sim', 'kartu_pelajar'])
                  ->nullable()->after('bukti_transfer');
 
            // Konfirmasi persetujuan syarat & ketentuan
            $table->boolean('setuju_syarat')->default(false)->after('jenis_jaminan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_bookings', function (Blueprint $table) {
            $table->dropColumn(['bukti_transfer', 'jenis_jaminan', 'setuju_syarat']);
        });
    }
};
