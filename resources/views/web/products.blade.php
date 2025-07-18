<x-layout>
    <!-- 🎯 Menyisipkan judul halaman ke dalam slot title -->
    <x-slot name="title">Koleksi Barang Antik</x-slot>

    <div class="container-fluid my-5">
        <!-- 🔍 Form pencarian global -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-9">
                <form method="GET" action="{{ url()->current() }}">
                    <div class="input-group input-group-lg shadow-sm">
                        <!-- Input pencarian, mempertahankan query sebelumnya -->
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari barang..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- 🖼️ Grid produk antik -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($products->isEmpty())
                    <!-- Jika tidak ada produk yang ditemukan -->
                    <div class="alert alert-info text-center">
                        Tidak ada barang antik yang cocok dengan pencarianmu.
                    </div>
                @else
                    <!-- Menampilkan daftar produk dalam bentuk grid -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($products as $product)
                            <div class="col">
                                <!-- Kartu produk -->
                                <div class="card h-100 shadow-sm">
                                    <!-- Gambar produk, fallback ke placeholder jika tidak ada -->
                                    <img src="{{ $product->image_url ? Storage::url($product->image_url) : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                                         class="card-img-top" alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">

                                    <div class="card-body">
                                        <!-- Nama produk -->
                                        <h5 class="card-title">{{ $product->name }}</h5>

                                        <!-- Badge tahun dan kondisi produk -->
                                        <div class="mb-2">
                                            @if($product->year_of_origin)
                                                <span class="badge bg-secondary">{{ $product->year_of_origin }}</span>
                                            @endif
                                            @if($product->condition)
                                                <span class="badge bg-info">{{ $product->condition }}</span>
                                            @endif
                                        </div>

                                        <!-- Deskripsi singkat (terpotong) -->
                                        <p class="card-text text-truncate">{{ $product->description }}</p>

                                        <!-- Harga & tombol detail -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fs-5 text-primary fw-bold">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                            <a href="{{ route('product.show', $product->slug) }}"
                                               class="btn btn-outline-primary btn-sm float-end">Lihat Detail
                                               
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Footer card: asal negara -->
                                    <!-- <div class="card-footer bg-white">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i> {{ $product->origin_country ?? 'Origin unknown' }}
                                        </small>
                                    </div> -->
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- 📄 Navigasi halaman (pagination) -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
