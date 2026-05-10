@props(['tool', 'whatsappNumber'])
@php
    use App\Helpers\Helpers;
@endphp

<div class="card h-100 shadow-sm">
    @if($tool->image)
        <img src="{{ asset('storage/' . $tool->image) }}" class="card-img-top" alt="{{ $tool->name }}" style="height: 200px; object-fit: cover;">
    @else
        <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
            <i class="bi bi-tools text-white" style="font-size: 48px;"></i>
        </div>
    @endif
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title">{{ $tool->name }}</h5>
            <span class="badge bg-{{ $tool->is_available && $tool->stock > 0 ? 'success' : 'danger' }}">
                {{ $tool->availability_badge }}
            </span>
        </div>
        <p class="card-text text-muted">{{ $tool->category }}</p>
        <p class="card-text">{{ Str::limit($tool->description, 100) }}</p>
        <h6 class="text-qof-primary">{{ Helpers::formatRupiah($tool->price_per_day) }} / hari</h6>
        <p class="small">Stok: {{ $tool->stock }}</p>
        @if($tool->is_available && $tool->stock > 0)
            <a href="{{ Helpers::whatsappLink($whatsappNumber, 'Halo, saya tertarik menyewa ' . $tool->name) }}" 
               class="btn btn-qof-primary w-100" target="_blank">
                <i class="bi bi-whatsapp"></i> Sewa Sekarang
            </a>
        @else
            <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
        @endif
    </div>
</div>