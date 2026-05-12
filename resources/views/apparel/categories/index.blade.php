@extends('adminlte::page')

@section('title', 'Kategori Produk')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-tags me-2" style="color: #0E7A96;"></i> Kategori Produk
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('apparel.dashboard') }}">Apparel</a></li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </div>
        <button data-toggle="modal" data-target="#addCategoryModal"
                style="display:inline-flex; align-items:center; gap:6px; background: linear-gradient(135deg, #0E7A96, #4EB8CC); border:none; color:#fff; padding:9px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; cursor:pointer; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       SECTION LABEL
       ============================================ */
    .sec-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94A3B8;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sec-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #E2E8F0;
    }

    /* ============================================
       DASH CARD & TABLE
       ============================================ */
    .dash-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
    }
    .dash-card-header {
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #F1F5F9;
    }
    .dash-card-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #0D1B2A;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-card-title i { color: #0E7A96; }

    .dash-table { width: 100%; border-collapse: collapse; }
    .dash-table thead th {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #94A3B8;
        padding: 10px 22px;
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
    }
    .dash-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.18s;
    }
    .dash-table tbody tr:last-child { border-bottom: none; }
    .dash-table tbody tr:hover { background: #F8FAFC; }
    .dash-table tbody td {
        padding: 13px 22px;
        font-size: 0.85rem;
        color: #0D1B2A;
        vertical-align: middle;
    }
    .td-muted {
        font-size: 0.75rem;
        color: #94A3B8;
        margin-top: 2px;
    }

    /* Row number badge */
    .row-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px; height: 28px;
        border-radius: 8px;
        background: #F1F5F9;
        color: #64748B;
        font-size: 0.75rem;
        font-weight: 700;
    }

    /* Product count badge */
    .badge-count {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    /* Action buttons */
    .btn-xs-act {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 8px;
        font-size: 0.78rem;
        border: none;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-xs-act.edit   { background: rgba(217,119,6,0.08);  color: #D97706; }
    .btn-xs-act.delete { background: rgba(220,38,38,0.08);  color: #DC2626; }
    .btn-xs-act:hover  { filter: brightness(0.88); }

    /* Empty row */
    .empty-row td {
        text-align: center;
        padding: 52px 20px !important;
        color: #94A3B8;
        font-size: 0.85rem;
    }
    .empty-icon-sm {
        font-size: 2.4rem;
        display: block;
        margin-bottom: 10px;
        opacity: 0.3;
    }

    /* ============================================
       MODAL
       ============================================ */
    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 24px 80px rgba(0,0,0,0.18);
        overflow: hidden;
    }
    .modal-header {
        background: linear-gradient(135deg, #0D1B2A 0%, #0E7A96 100%);
        border: none;
        padding: 20px 26px;
        position: relative;
        overflow: hidden;
    }
    .modal-header::before {
        content: '';
        position: absolute;
        top: -20px; right: -20px;
        width: 100px; height: 100px;
        background: radial-gradient(circle, rgba(78,184,204,0.3) 0%, transparent 70%);
        border-radius: 50%;
    }
    .modal-header .modal-title {
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        position: relative;
        z-index: 1;
    }
    .modal-header .close {
        color: rgba(255,255,255,0.7);
        opacity: 1;
        text-shadow: none;
        font-size: 1.3rem;
        position: relative;
        z-index: 1;
        transition: color 0.2s;
    }
    .modal-header .close:hover { color: #fff; }
    .modal-body {
        padding: 24px 26px 16px;
    }
    .modal-footer {
        padding: 14px 26px 22px;
        border: none;
        gap: 10px;
    }

    /* Modal form elements */
    .modal .form-label-custom {
        font-weight: 600;
        font-size: 0.82rem;
        color: #0D1B2A;
        margin-bottom: 6px;
        display: block;
    }
    .modal .form-control-custom {
        width: 100%;
        border-radius: 12px;
        padding: 10px 14px;
        border: 1.5px solid #E2E8F0;
        font-size: 0.875rem;
        transition: all 0.3s;
        background: #F8FAFC;
        font-family: inherit;
        outline: none;
    }
    .modal .form-control-custom:focus {
        border-color: #4EB8CC;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.12);
        background: #fff;
    }
    .modal .form-control-custom::placeholder { color: #94A3B8; }

    /* Modal buttons */
    .btn-modal-cancel {
        background: #F1F5F9;
        border: none;
        border-radius: 10px;
        padding: 9px 20px;
        font-weight: 600;
        font-size: 0.85rem;
        color: #64748B;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-modal-cancel:hover { background: #E2E8F0; color: #475569; }

    .btn-modal-submit {
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        border: none;
        border-radius: 10px;
        padding: 9px 22px;
        font-weight: 700;
        font-size: 0.85rem;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-modal-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(14,122,150,0.3);
    }

    /* Alert */
    .alert-custom {
        border-radius: 12px;
        font-size: 0.85rem;
        padding: 12px 16px;
        border: none;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .alert-custom.success { background: #D1FAE5; color: #065F46; }
    .alert-custom.error   { background: #FEE2E2; color: #991B1B; }
</style>
@endpush

@section('content')

    @if(session('success'))
        <div class="alert-custom success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-custom error">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    <p class="sec-label">Daftar Kategori</p>

    <div class="dash-card">
        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="fas fa-tags"></i> Semua Kategori
                <span style="background:#EEF9FC; color:#0E7A96; padding:2px 10px; border-radius:50px; font-size:0.72rem; font-weight:700;">
                    {{ ($categories ?? collect())->count() }} kategori
                </span>
            </div>
        </div>

        <table class="dash-table">
            <thead>
                <tr>
                    <th width="60">#</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Produk</th>
                    <th>Tanggal Dibuat</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories ?? [] as $category)
                    <tr>
                        <td><span class="row-num">{{ $loop->iteration }}</span></td>
                        <td>
                            <div style="font-weight: 700;">{{ $category->name }}</div>
                        </td>
                        <td>
                            <span class="badge-count">
                                <i class="fas fa-box" style="font-size:0.65rem;"></i>
                                {{ $category->products_count ?? 0 }} produk
                            </span>
                        </td>
                        <td>
                            <div class="td-muted">
                                <i class="far fa-calendar-alt me-1"></i>{{ $category->created_at->format('d M Y') }}
                            </div>
                        </td>
                        <td style="white-space: nowrap;">
                            <button class="btn-xs-act edit edit-category"
                                    data-id="{{ $category->id }}"
                                    data-name="{{ $category->name }}"
                                    data-toggle="modal"
                                    data-target="#editCategoryModal"
                                    title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('apparel.categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn-xs-act delete ms-1"
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="5">
                            <i class="fas fa-tags empty-icon-sm"></i>
                            Belum ada kategori produk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── MODAL TAMBAH KATEGORI ── --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('apparel.categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i> Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label-custom">Nama Kategori</label>
                        <input type="text"
                               name="name"
                               class="form-control-custom"
                               placeholder="Contoh: Kaos, Jaket, Hoodie..."
                               required
                               autofocus>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn-modal-submit">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── MODAL EDIT KATEGORI ── --}}
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Edit Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label-custom">Nama Kategori</label>
                        <input type="text"
                               name="name"
                               id="editCategoryName"
                               class="form-control-custom"
                               placeholder="Nama kategori..."
                               required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn-modal-submit">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@push('js')
<script>
    $('.edit-category').click(function () {
        var id   = $(this).data('id');
        var name = $(this).data('name');
        $('#editCategoryName').val(name);
        $('#editCategoryForm').attr('action', '/apparel/categories/' + id);
    });
</script>
@endpush