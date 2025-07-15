<x-layout>
    {{-- Judul Halaman --}}
    <x-slot name="title">Homepage</x-slot>

    {{-- Jika $categories belum ada, buat kosong --}}
    @if(!isset($categories))
        @php $categories = collect(); @endphp
    @endif

    {{-- CSS Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CSS Responsif Tambahan --}}
    <style>
        @media (max-width: 576px) {
            h3 {
                font-size: 1.25rem !important;
            }
            .card-title {
                font-size: 1rem;
            }
            .card-text {
                font-size: 0.875rem;
            }
        }
    </style>

    {{-- CAROUSEL / SLIDER --}}
    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('theme/hexashop/assets/images/dhasboard.jpeg.jpg') }}"
                     class="d-block w-100 img-fluid"
                     alt="Reloka 1"
                     style="min-height: 200px; height: 40vh; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('theme/hexashop/assets/images/logo reloka.jpg') }}"
                     class="d-block w-100 img-fluid"
                     alt="Reloka 2"
                     style="min-height: 200px; height: 40vh; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('theme/hexashop/assets/images/dashboard2.jpeg') }}"
                     class="d-block w-100 img-fluid"
                     alt="Reloka 3"
                     style="min-height: 200px; height: 40vh; object-fit: cover;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- KATEGORI PRODUK --}}
    <div class="container py-3 px-3 px-md-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Kategori Produk</h3>
            <a href="{{ url('/categories') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Kategori</a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @foreach ($categories as $category)
                <div class="col">
                    <a href="{{ url('/category/' . $category->slug) }}" class="card text-decoration-none">
                        <div class="card category-card text-center h-100 py-3 border-0 shadow-sm">
                            <div class="mx-auto mb-2"
                                 style="width:150px;height:150px;display:flex;align-items:center;justify-content:center;background:#f8f9fa;border-radius:0.25rem;">
                                <img src="{{ $category->image ? Storage::url($category->image) : 'https://via.placeholder.com/150?text=No+Image' }}"
                                     alt="{{ $category->name }}"
                                     class="img-fluid"
                                     style="width:150px;height:150px;object-fit:cover;border-radius:0.25rem;">
                            </div>
                            <div class="card-body p-2">
                                <h6 class="card-title text-dark mb-1">{{ $category->name }}</h6>
                                <p class="card-text text-muted small text-truncate">{{ $category->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- PRODUK KAMI --}}
    <div class="container py-3 px-3 px-md-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Produk Kami</h3>
            <a href="{{ url('/products') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Produk</a>
        </div>

        <!-- 🔍 Global Search -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-9">
                <form method="GET" action="{{ url()->current() }}">
                    <div class="input-group input-group-lg shadow-sm">
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari barang..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @forelse ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card product-card h-100 shadow-sm">
                        <img src="{{ $product->image_url ? Storage::url($product->image_url) : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                             class="card-img-top img-fluid"
                             alt="{{ $product->name }}"
                             style="max-height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-truncate">{{ $product->description }}</p>
                            <div class="mt-auto">
                                <span class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}"
                                   class="btn btn-outline-primary btn-sm float-end">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info">Belum ada produk pada kategori ini.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>
</x-layout>
