<x-layout>
    {{-- Judul halaman di tab browser --}}
    <x-slot name="title">{{ $category->name }}</x-slot>

    <div class="container py-3">
        {{-- Gambar kategori --}}
        <img src="{{ $category->image ? Storage::url($category->image) : 'https://via.placeholder.com/350x250?text=No+Image' }}"
            alt="{{ $category->name }}"
            class="d-block mx-auto rounded"
            style="height: 350px; object-fit: cover;">

        {{-- Header kategori + tombol lihat semua --}}
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <h3 style="font-size: 1.5rem;">Kategori: {{ $category->name }}</h3>
            <a href="{{ url('/categories') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Kategori</a>
        </div>

        {{-- Daftar produk dalam kategori --}}
        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100 shadow-sm">
                        {{-- Gambar produk --}}
                        <img src="{{ $product->image_url ? Storage::url($product->image_url) : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                            class="card-img-top" alt="{{ $product->name }}"
                            style="width: 100%; height: 200px; object-fit: cover;">
                        
                        {{-- Konten produk --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-truncate">{{ $product->description }}</p>
                            
                            {{-- Harga + tombol detail --}}
                            <div class="mt-auto">
                                <span class="fw-bold text-primary">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}"
                                    class="btn btn-outline-primary btn-sm float-end">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Jika tidak ada produk --}}
                <div class="col">
                    <div class="alert alert-info">Belum ada produk pada kategori ini.</div>
                </div>
            @endforelse
        </div>

        {{-- Navigasi halaman --}}
        <div class="d-flex justify-content-center w-100 mt-4">
            {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>
</x-layout>
