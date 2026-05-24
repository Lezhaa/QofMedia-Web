<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Refactor tabel orders:
     * - Hapus kolom terkait Midtrans (snap_token, midtrans_transaction_id, payment_token)
     * - Hapus payment_method payment_gateway
     * - Tambah kolom alamat terstruktur: provinsi, kab_kota, alamat_detail, kode_pos
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus kolom Midtrans jika ada
            if (Schema::hasColumn('orders', 'snap_token')) {
                $table->dropColumn('snap_token');
            }
            if (Schema::hasColumn('orders', 'midtrans_transaction_id')) {
                $table->dropColumn('midtrans_transaction_id');
            }
            if (Schema::hasColumn('orders', 'payment_token')) {
                $table->dropColumn('payment_token');
            }

            // Tambah kolom alamat terstruktur
            if (!Schema::hasColumn('orders', 'provinsi')) {
                $table->string('provinsi', 100)->nullable()->after('pemesan_phone');
            }
            if (!Schema::hasColumn('orders', 'kab_kota')) {
                $table->string('kab_kota', 100)->nullable()->after('provinsi');
            }
            if (!Schema::hasColumn('orders', 'alamat_detail')) {
                $table->text('alamat_detail')->nullable()->after('kab_kota');
            }
            if (!Schema::hasColumn('orders', 'kode_pos')) {
                $table->string('kode_pos', 10)->nullable()->after('alamat_detail');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('snap_token')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->dropColumn(['provinsi', 'kab_kota', 'alamat_detail', 'kode_pos']);
        });
    }
};
