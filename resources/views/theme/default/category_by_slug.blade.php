<x-layout>
    <x-slot name="title">{{ $category->name }}</x-slot>

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <h3 class="mb-2" style="font-size: 1.7rem;">{{ $category->name }}</h3>
                <p class="text-muted">{{ $category->description }}</p>
            </div>
        </div>
        <div class="row row-cols-3 row-cols-md-3 g-4 justify-content-center">
            @forelse($products as $product)
                <div class="col mb-4">
                    <div class="card product-card h-100 shadow-sm">
                        <div class="text-center pt-3">
                            <div class="d-flex justify-content-center align-items-center rounded-circle border border-3 border-secondary-subtle bg-light" style="width: 80px; height: 80px; margin: auto;">
                                <img src="{{ $product->image_url ? $product->image_url : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                                     alt="{{ $product->name }}"
                                     style="width: 72px; height: 72px; object-fit: cover; border-radius: 8px;">
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-truncate">{{ $product->description }}</p>
                            <div class="mt-auto">
                                <span class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-primary btn-sm float-end">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info">Belum ada produk pada kategori ini.</div>
                </div>
            @endforelse

            <div class="d-flex justify-content-center w-100 mt-4">
                {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
            </div>
        </div>
    </div>
    
</x-layout>