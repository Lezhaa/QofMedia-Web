@extends('adminlte::page')

@section('title', 'Edit Divisi: ' . $division->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-sitemap me-2" style="color: #0E7A96;"></i> Edit Divisi
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.divisions.index') }}">Divisi</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
        <a href="{{ route('admin.divisions.index') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#F8FAFC; color:#64748B; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:1.5px solid #E2E8F0; transition:all 0.3s;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       LAYOUT
       ============================================ */
    .edit-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 20px;
        align-items: start;
    }
    @media (max-width: 900px) {
        .edit-grid { grid-template-columns: 1fr; }
    }

    /* ============================================
       SECTION CARD
       ============================================ */
    .section-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .section-card:last-child { margin-bottom: 0; }

    .section-card-header {
        padding: 16px 24px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-card-header .icon-wrap {
        width: 34px; height: 34px;
        background: rgba(14,122,150,0.09);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .section-card-header h6 {
        margin: 0;
        font-size: 0.88rem;
        font-weight: 700;
        color: #0D1B2A;
    }
    .section-card-body { padding: 24px; }

    /* ============================================
       FORM FIELDS
       ============================================ */
    .field-group { margin-bottom: 18px; }
    .field-group:last-child { margin-bottom: 0; }

    .field-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94A3B8;
        margin-bottom: 7px;
    }
    .field-label .req { color: #EF4444; margin-left: 2px; }

    .field-input {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        color: #0D1B2A;
        background: #F8FAFC;
        outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .field-input:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.10);
    }
    .field-input.is-invalid {
        border-color: #EF4444;
        background: #FFF5F5;
    }
    textarea.field-input { resize: vertical; min-height: 110px; line-height: 1.6; }

    .invalid-msg {
        font-size: 0.76rem;
        color: #EF4444;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .field-hint { font-size: 0.76rem; color: #94A3B8; margin-top: 5px; margin-bottom: 0; }

    /* SELECT */
    select.field-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394A3B8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
        cursor: pointer;
    }

    /* ============================================
       INSTAGRAM INPUT WITH ICON
       ============================================ */
    .input-icon-wrap {
        position: relative;
    }
    .input-icon-wrap .input-icon {
        position: absolute;
        left: 12px; top: 50%;
        transform: translateY(-50%);
        color: #C13584;
        font-size: 0.9rem;
        pointer-events: none;
    }
    .input-icon-wrap .field-input { padding-left: 34px; }

    /* ============================================
       STATUS DOT
       ============================================ */
    .status-wrap { position: relative; }
    .status-dot {
        position: absolute;
        left: 12px; top: 50%;
        transform: translateY(-50%);
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #10B981;
        pointer-events: none;
        transition: background 0.2s;
    }
    .status-dot.inactive { background: #94A3B8; }
    .status-wrap select.field-input { padding-left: 28px; }

    /* ============================================
       DIVISI IDENTITY CARD (sidebar)
       ============================================ */
    .identity-chip {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px;
        background: linear-gradient(135deg, rgba(14,122,150,0.07), rgba(14,122,150,0.03));
        border-radius: 14px;
        border: 1px solid rgba(14,122,150,0.15);
        margin-bottom: 18px;
    }
    .identity-icon {
        width: 48px; height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0E7A96, #0a5a70);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(14,122,150,0.28);
    }
    .identity-info strong {
        display: block;
        font-size: 0.95rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 2px;
    }
    .identity-info span {
        font-size: 0.76rem;
        color: #94A3B8;
    }

    /* ============================================
       META ROW (urutan + status)
       ============================================ */
    .meta-two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    /* ============================================
       ACTION BAR
       ============================================ */
    .action-bar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    .action-bar .left-info {
        font-size: 0.82rem;
        color: #94A3B8;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .action-bar .left-info i { color: #CBD5E1; }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #0E7A96;
        color: #fff;
        padding: 11px 28px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: none;
        cursor: pointer;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(14,122,150,0.28);
        text-decoration: none;
    }
    .btn-save:hover {
        background: #0a5a70;
        box-shadow: 0 6px 20px rgba(14,122,150,0.38);
        transform: translateY(-1px);
        color: #fff;
    }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #F8FAFC;
        color: #64748B;
        padding: 11px 22px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: 1.5px solid #E2E8F0;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-cancel:hover {
        background: #F1F5F9;
        color: #0D1B2A;
        text-decoration: none;
    }

    /* ============================================
       ALERT
       ============================================ */
    .alert-success-custom {
        border-radius: 12px;
        border: none;
        background: #D1FAE5;
        color: #065F46;
        font-size: 0.88rem;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    @endif

    <form action="{{ route('admin.divisions.update', $division) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="edit-grid">

            {{-- ==================== KOLOM KIRI (UTAMA) ==================== --}}
            <div>

                {{-- Informasi Divisi --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-sitemap"></i></div>
                        <h6>Informasi Divisi</h6>
                    </div>
                    <div class="section-card-body">

                        {{-- Nama Divisi --}}
                        <div class="field-group">
                            <label class="field-label" for="name">
                                Nama Divisi <span class="req">*</span>
                            </label>
                            <input type="text"
                                   id="name" name="name"
                                   class="field-input @error('name') is-invalid @enderror"
                                   value="{{ old('name', $division->name) }}"
                                   placeholder="Masukkan nama divisi"
                                   required
                                   oninput="syncIdentityName(this.value)">
                            @error('name')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="field-group">
                            <label class="field-label" for="description">Deskripsi</label>
                            <textarea id="description" name="description"
                                      class="field-input @error('description') is-invalid @enderror"
                                      placeholder="Tuliskan deskripsi singkat tentang divisi ini...">{{ old('description', $division->description) }}</textarea>
                            @error('description')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Media Sosial --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-share-alt"></i></div>
                        <h6>Media Sosial <span style="font-size:0.75rem; color:#94A3B8; font-weight:500;">(Opsional)</span></h6>
                    </div>
                    <div class="section-card-body">
                        <div class="field-group" style="margin-bottom:0;">
                            <label class="field-label" for="instagram">Instagram</label>
                            <div class="input-icon-wrap">
                                <i class="fab fa-instagram input-icon"></i>
                                <input type="text"
                                       id="instagram" name="instagram"
                                       class="field-input @error('instagram') is-invalid @enderror"
                                       value="{{ old('instagram', $division->instagram) }}"
                                       placeholder="username tanpa @, contoh: divisi.kreativitas">
                            </div>
                            @error('instagram')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                            <p class="field-hint">Masukkan username Instagram tanpa tanda @.</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ==================== KOLOM KANAN (SIDEBAR) ==================== --}}
            <div>

                {{-- Identitas Card --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-id-badge"></i></div>
                        <h6>Pratinjau</h6>
                    </div>
                    <div class="section-card-body">
                        <div class="identity-chip">
                            <div class="identity-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div class="identity-info">
                                <strong id="previewName">{{ $division->name }}</strong>
                                <span>Divisi Aktif</span>
                            </div>
                        </div>
                        <p class="field-hint" style="text-align:center;">
                            Nama akan diperbarui saat Anda mengetik.
                        </p>
                    </div>
                </div>

                {{-- Tampilan & Status --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-sliders-h"></i></div>
                        <h6>Tampilan & Status</h6>
                    </div>
                    <div class="section-card-body">
                        <div class="meta-two-col">
                            {{-- Urutan --}}
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="order">Urutan</label>
                                <input type="number"
                                       id="order" name="order"
                                       class="field-input"
                                       value="{{ old('order', $division->order) }}"
                                       min="0"
                                       placeholder="0">
                                <p class="field-hint">Kecil → atas</p>
                            </div>
                            {{-- Status --}}
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="is_active">Status</label>
                                <div class="status-wrap">
                                    <span class="status-dot" id="statusDot"></span>
                                    <select name="is_active" id="is_active"
                                            class="field-input"
                                            onchange="updateStatusDot()">
                                        <option value="1" {{ old('is_active', $division->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $division->is_active) == '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Action Bar --}}
        <div class="action-bar">
            <div class="left-info">
                <i class="fas fa-info-circle"></i>
                Field bertanda <span style="color:#EF4444; font-weight:700; margin:0 3px;">*</span> wajib diisi.
            </div>
            <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <a href="{{ route('admin.divisions.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Update Divisi
                </button>
            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    // Live preview nama divisi
    function syncIdentityName(val) {
        const preview = document.getElementById('previewName');
        if (preview) preview.textContent = val.trim() || '—';
    }

    // Status dot
    function updateStatusDot() {
        const val = document.getElementById('is_active').value;
        const dot = document.getElementById('statusDot');
        dot.classList.toggle('inactive', val !== '1');
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateStatusDot();
    });
</script>
@endpush