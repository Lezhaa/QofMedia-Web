<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $orders;
    protected $totalPendapatan;

    public function __construct($orders, $totalPendapatan)
    {
        $this->orders = $orders;
        $this->totalPendapatan = $totalPendapatan;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'ID Order',
            'Pemesan',
            'Tanggal Transaksi',
            'Total (Rp)',
            'Status Bukti',
            'Tanggal Dibuat'
        ];
    }

    public function map($order): array
    {
        $proofStatus = [
            'valid' => 'Valid',
            'invalid' => 'Tidak Valid',
            'pending' => 'Pending'
        ];

        return [
            '#' . $order->id,
            $order->pemesan_name,
            $order->updated_at->format('d M Y'),
            number_format($order->total_price, 0, ',', '.'),
            $proofStatus[$order->payment_proof_validated ?? 'pending'],
            $order->created_at->format('d M Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}