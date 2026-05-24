<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Apparel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #0E7A96;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #0D1B2A;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0;
            color: #64748B;
        }
        .summary {
            margin-bottom: 20px;
            padding: 15px;
            background: #F8FAFC;
            border-radius: 8px;
        }
        .summary table {
            width: 100%;
        }
        .summary td {
            padding: 5px;
        }
        .summary .label {
            font-weight: bold;
            width: 150px;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table.data th {
            background: #0E7A96;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
        }
        table.data td {
            border: 1px solid #E2E8F0;
            padding: 8px 10px;
        }
        table.data tr:nth-child(even) {
            background: #F8FAFC;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #94A3B8;
            border-top: 1px solid #E2E8F0;
            padding-top: 10px;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-valid {
            background: #D1FAE5;
            color: #065F46;
        }
        .badge-invalid {
            background: #FEE2E2;
            color: #991B1B;
        }
        .badge-pending {
            background: #FEF3C7;
            color: #92400E;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background: #F1F5F9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KEUANGAN APPAREL</h1>
        <p>QofMedia Apparel Store</p>
        <p>Periode: <?php echo e($periode); ?> | Dicetak: <?php echo e($tanggal_cetak); ?></p>
    </div>

    <div class="summary">
        <table>
            <tr>
                <td class="label">Total Pendapatan</td>
                <td>: <strong>Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></strong></td>
            </tr>
            <tr>
                <td class="label">Total Transaksi Sukses</td>
                <td>: <?php echo e($totalTransaksi); ?> transaksi</td>
            </tr>
            <tr>
                <td class="label">Rata-rata per Transaksi</td>
                <td>: Rp <?php echo e(number_format($rataRata, 0, ',', '.')); ?></td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Pemesan</th>
                <th>Tanggal</th>
                <th>Total (Rp)</th>
                <th>Status Bukti</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $proofStatus = $order->payment_proof_validated ?? 'pending';
                    $badgeClass = match($proofStatus) {
                        'valid' => 'badge-valid',
                        'invalid' => 'badge-invalid',
                        default => 'badge-pending'
                    };
                    $statusText = match($proofStatus) {
                        'valid' => 'Valid',
                        'invalid' => 'Tidak Valid',
                        default => 'Pending'
                    };
                ?>
                <tr>
                    <td>#<?php echo e($order->id); ?></td>
                    <td><?php echo e($order->pemesan_name); ?></td>
                    <td><?php echo e($order->updated_at->format('d M Y')); ?></td>
                    <td class="text-right">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                    <td>
                        <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($statusText); ?></span>
                    </td>
                    <td><?php echo e($order->created_at->format('d M Y H:i')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                <td class="text-right"><strong>Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></strong></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis dari sistem QofMedia Apparel</p>
        <p>&copy; <?php echo e(date('Y')); ?> QofMedia - All Rights Reserved</p>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/finances/export-pdf.blade.php ENDPATH**/ ?>