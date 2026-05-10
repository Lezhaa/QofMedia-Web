@props(['product'])

<div class="card h-100 shadow-sm">
    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
    <div class="card-body">
        <span class="badge bg-info mb-2">{{ $product->category->name }}</span>
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
        <h6 class="text-qof-primary mb-2">{{ $product->formatted_price }}</h6>
        <p class="small">Stok: {{ $product->stock }}</p>
        <a href="{{ route('apparel.product.show', $product) }}" class="btn btn-outline-primary w-100">
            Lihat Detail
        </a>
    </div>
</div>