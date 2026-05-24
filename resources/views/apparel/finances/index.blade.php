@extends('adminlte::page')

@section('title', 'Laporan Keuangan Apparel')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-chart-line me-2" style="color: #0E7A96;"></i> Laporan Keuangan Apparel
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Laporan Keuangan</li>
            </ol>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('apparel.finance.export-excel') }}" 
               style="display:inline-flex; align-items:center; gap:7px; background:#10B981; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; transition:all 0.3s;">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('apparel.finance.export-pdf') }}" 
               style="display:inline-flex; align-items:center; gap:7px; background:#EF4444; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; transition:all 0.3s;">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('apparel.orders.index') }}"
               style="display:inline-flex; align-items:center; gap:7px; background:#F8FAFC; color:#64748B; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:1.5px solid #E2E8F0; transition:all 0.3s;">
                <i class="fas fa-shopping-cart"></i> Kelola Order
            </a>
        </div>
    </div>
@stop

@push('css')
<style>
    .stat-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 22px 22px 18px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        transition: all 0.28s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 0 0 18px 18px;
        background: var(--c);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.08);
        border-color: transparent;
    }
    .stat-card:hover::after { opacity: 1; }
    .stat-card.green { --c: #059669; }
    .stat-card:hover.green { box-shadow: 0 10px 28px rgba(5,150,105,0.14); border-color: #34D399; }
    .stat-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        background: var(--ic-bg);
        color: var(--c);
        transition: transform 0.3s;
    }
    .stat-card:hover .stat-icon { transform: scale(1.1) rotate(-4deg); }
    .stat-card.green .stat-icon { --ic-bg: #D1FAE5; }
    .stat-info .stat-number {
        font-size: 1.55rem;
        font-weight: 800;
        color: #0D1B2A;
        line-height: 1;
        margin-bottom: 4px;
        word-break: break-all;
    }
    .stat-info .stat-label {
        font-size: 0.8rem;
        color: #64748B;
        font-weight: 500;
    }
    .section-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .section-card-header {
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        padding: 15px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .section-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        font-weight: 700;
        color: #0D1B2A;
    }
    .section-card-title .hdr-icon {
        width: 32px; height: 32px;
        background: rgba(14,122,150,0.1);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 0.82rem;
        flex-shrink: 0;
    }
    .section-card-body { padding: 24px; }
    .report-table { width: 100%; border-collapse: collapse; }
    .report-table thead th {
        background: #F8FAFC;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94A3B8;
        padding: 11px 20px;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }
    .report-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .report-table tbody tr:last-child { border-bottom: none; }
    .report-table tbody tr:hover { background: #FAFCFE; }
    .report-table tbody td {
        padding: 13px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }
    .order-id {
        font-size: 0.78rem;
        font-weight: 700;
        color: #94A3B8;
        font-family: monospace;
    }
    .order-name { font-weight: 700; color: #0D1B2A; font-size: 0.88rem; }
    .order-date {
        font-size: 0.82rem;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }
    .order-date i { color: #CBD5E1; font-size: 0.72rem; }
    .order-total {
        font-weight: 700;
        color: #059669;
        font-size: 0.88rem;
        white-space: nowrap;
    }
    .badge-success-custom {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(5,150,105,0.09);
        color: #059669;
        border-radius: 50px;
        padding: 3px 10px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    .badge-bukti {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    .badge-bukti.valid {
        background: rgba(5,150,105,0.12);
        color: #059669;
    }
    .badge-bukti.invalid {
        background: rgba(220,38,38,0.12);
        color: #DC2626;
    }
    .badge-bukti.pending {
        background: rgba(245,158,11,0.12);
        color: #D97706;
    }
    .bukti-link {
        color: #0E7A96;
        text-decoration: none;
        font-size: 0.7rem;
        margin-left: 6px;
    }
    .bukti-link:hover { text-decoration: underline; }
    .filter-bar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 13px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .filter-bar input {
        border: 1.5px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.85rem;
        outline: none;
        color: #0D1B2A;
        background: #F8FAFC;
        transition: border-color 0.2s;
        flex: 1;
        min-width: 180px;
    }
    .filter-bar input:focus { border-color: #0E7A96; background: #fff; }
    .chart-container {
        position: relative;
        width: 100%;
        height: 280px;
    }
    .pagination .page-link svg { display: none !important; }
    .pagination .page-item:first-child .page-link::after { content: '« Prev'; }
    .pagination .page-item:last-child .page-link::after { content: 'Next »'; }
    .pagination { gap: 4px; flex-wrap: wrap; }
    .pagination .page-link {
        border-radius: 8px !important;
        padding: 7px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #0D1B2A;
        border: 1.5px solid #E2E8F0;
        background: #fff;
        transition: all 0.2s;
    }
    .pagination .page-link:hover { background: #0E7A96; color: #fff; border-color: #0E7A96; }
    .pagination .page-item.active .page-link {
        background: #0E7A96; border-color: #0E7A96; color: #fff;
        box-shadow: 0 4px 12px rgba(14,122,150,0.25);
    }
    .pagination .page-item.disabled .page-link {
        background: #F8FAFC; color: #CBD5E1; border-color: #E2E8F0;
    }
    .card-foot {
        padding: 14px 20px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        justify-content: center;
    }
    .empty-state { text-align: center; padding: 50px 20px; }
    .empty-icon-wrap {
        width: 70px; height: 70px;
        background: #EEF9FC;
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px;
        font-size: 1.7rem;
        color: #0E7A96;
        opacity: 0.6;
    }
    .empty-state h6 { font-weight: 700; color: #0D1B2A; margin-bottom: 4px; }
    .empty-state p { color: #94A3B8; font-size: 0.85rem; }
</style>
@endpush

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-lg-4 col-sm-6">
            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
                <div class="stat-info">
                    <div class="stat-number">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    <div class="stat-label">Total Pendapatan Sukses</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="stat-card" style="--c:#0E7A96;">
                <div class="stat-icon" style="--ic-bg:#EEF9FC; background:#EEF9FC; color:#0E7A96;">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-number">{{ $orders->total() }}</div>
                    <div class="stat-label">Total Transaksi Sukses</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="stat-card" style="--c:#7C3AED;">
                <div class="stat-icon" style="background:#EDE9FE; color:#7C3AED;">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-number">{{ $chartData->count() }}</div>
                    <div class="stat-label">Bulan Aktif</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-card">
        <div class="section-card-header">
            <div class="section-card-title">
                <div class="hdr-icon"><i class="fas fa-chart-bar"></i></div>
                Grafik Pendapatan Bulanan
            </div>
            <span style="font-size:0.75rem; color:#94A3B8; font-weight:500;">
                <i class="fas fa-circle" style="color:#0E7A96; font-size:0.55rem;"></i>
                IDR (Rupiah)
            </span>
        </div>
        <div class="section-card-body">
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <div class="section-card">
        <div class="section-card-header">
            <div class="section-card-title">
                <div class="hdr-icon"><i class="fas fa-list-alt"></i></div>
                Rincian Transaksi Berhasil
            </div>
            <span class="badge-success-custom">
                <i class="fas fa-check-circle"></i> {{ $orders->total() }} transaksi
            </span>
        </div>

        <div style="padding: 14px 24px 0;">
            <div class="filter-bar" style="margin-bottom: 0;">
                <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
                <input type="text" id="searchInput" placeholder="Cari nama pemesan..." oninput="filterRows()">
            </div>
        </div>

        @if($orders->total() > 0)
            <div style="overflow-x: auto; margin-top: 14px;">
                <table class="report-table" id="reportTable">
                    <thead>
                        <tr>
                            <th style="width:70px;">ID Order</th>
                            <th>Pemesan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th style="width:120px;">Status Bukti</th>
                            <th style="width:80px;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="rpt-row" data-name="{{ strtolower($order->pemesan_name) }}">
                                <td><span class="order-id">#{{ $order->id }}</span></td>
                                <td><span class="order-name">{{ $order->pemesan_name }}</span></td>
                                <td>
                                    <div class="order-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $order->updated_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="order-total">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $proofStatus = $order->payment_proof_validated ?? 'pending';
                                        $proofPath = $order->payment_proof ?? null;
                                    @endphp
                                    @if($proofPath)
                                        <span class="badge-bukti {{ $proofStatus == 'valid' ? 'valid' : ($proofStatus == 'invalid' ? 'invalid' : 'pending') }}">
                                            @if($proofStatus == 'valid')
                                                <i class="fas fa-check-circle"></i> Valid
                                            @elseif($proofStatus == 'invalid')
                                                <i class="fas fa-times-circle"></i> Tidak Valid
                                            @else
                                                <i class="fas fa-clock"></i> Pending
                                            @endif
                                        </span>
                                        <a href="{{ asset('storage/' . $proofPath) }}" target="_blank" class="bukti-link" title="Lihat Bukti">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @else
                                        <span class="badge-bukti pending" style="background:#F1F5F9; color:#94A3B8;">
                                            <i class="fas fa-image"></i> Tidak Ada
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('apparel.orders.show', $order->id) }}" 
                                       style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:6px 14px; border-radius:8px; font-size:0.75rem; font-weight:600; text-decoration:none; transition:all 0.2s;">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(method_exists($orders, 'hasPages') && $orders->hasPages())
                <div class="card-foot">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-receipt"></i></div>
                <h6>Belum Ada Transaksi</h6>
                <p>Transaksi yang berhasil akan muncul di sini.</p>
            </div>
        @endif
    </div>
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function filterRows() {
        var search = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('.rpt-row').forEach(function (row) {
            row.style.display = row.dataset.name.includes(search) ? '' : 'none';
        });
    }

    const labels = {!! json_encode($chartData->pluck('month')) !!};
    const dataValues = {!! json_encode($chartData->pluck('total')) !!};

    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (IDR)',
                data: dataValues,
                backgroundColor: 'rgba(14, 122, 150, 0.15)',
                borderColor: 'rgba(14, 122, 150, 1)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                hoverBackgroundColor: 'rgba(14, 122, 150, 0.28)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0D1B2A',
                    titleColor: '#fff',
                    bodyColor: 'rgba(255,255,255,0.75)',
                    padding: 12,
                    cornerRadius: 10,
                    callbacks: {
                        label: function(ctx) {
                            return ' Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#94A3B8', font: { size: 12, weight: '600' } },
                    border: { display: false }
                },
                y: {
                    grid: { color: '#F1F5F9', drawBorder: false },
                    ticks: {
                        color: '#94A3B8',
                        font: { size: 11 },
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp ' + (value/1000000).toFixed(1) + 'jt';
                            if (value >= 1000) return 'Rp ' + (value/1000).toFixed(0) + 'rb';
                            return 'Rp ' + value;
                        }
                    },
                    border: { display: false }
                }
            }
        }
    });
</script>
@endpush