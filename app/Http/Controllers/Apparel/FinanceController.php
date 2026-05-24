<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Exports\ReportExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class FinanceController extends Controller
{
    public function index()
    {
        $totalPendapatan = Order::where('payment_status', 'paid')->sum('total_price');

        $chartData = Order::where('payment_status', 'paid')
            ->whereNotNull('paid_at')
            ->selectRaw("DATE_FORMAT(paid_at, '%Y-%m') as month, SUM(total_price) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $date = Carbon::createFromFormat('Y-m', $item->month);
                $item->month = $date->format('M Y');
                return $item;
            });

        $orders = Order::where('payment_status', 'paid')
            ->select('id', 'pemesan_name', 'updated_at', 'total_price', 'payment_proof', 'payment_proof_validated')
            ->latest('paid_at')
            ->paginate(20);

        return view('apparel.finances.index', compact('totalPendapatan', 'chartData', 'orders'));
    }

    /**
     * Export ke Excel
     */
    public function exportExcel()
    {
        $orders = Order::where('payment_status', 'paid')
            ->select('id', 'pemesan_name', 'updated_at', 'total_price', 'payment_proof', 'payment_proof_validated', 'created_at')
            ->latest('paid_at')
            ->get();

        $totalPendapatan = $orders->sum('total_price');

        $export = new ReportExport($orders, $totalPendapatan);
        
        $fileName = 'laporan_keuangan_apparel_' . Carbon::now()->format('Y-m-d_His') . '.xlsx';
        
        return Excel::download($export, $fileName);
    }

    /**
     * Export ke PDF
     */
    public function exportPdf()
    {
        $orders = Order::where('payment_status', 'paid')
            ->select('id', 'pemesan_name', 'updated_at', 'total_price', 'payment_proof', 'payment_proof_validated', 'created_at')
            ->latest('paid_at')
            ->get();

        $totalPendapatan = $orders->sum('total_price');
        $totalTransaksi = $orders->count();
        $rataRata = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        $data = [
            'orders' => $orders,
            'totalPendapatan' => $totalPendapatan,
            'totalTransaksi' => $totalTransaksi,
            'rataRata' => $rataRata,
            'tanggal_cetak' => Carbon::now()->format('d F Y H:i'),
            'periode' => 'Semua Waktu'
        ];

        $pdf = Pdf::loadView('apparel.finances.export-pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('laporan_keuangan_apparel_' . Carbon::now()->format('Y-m-d_His') . '.pdf');
    }
}