<x-layout>
    {{-- Judul halaman yang akan digunakan di layout --}}
    <x-slot:title>About Us - Reloka</x-slot>

    <div class="container py-5">
        <div class="row align-items-center">
            {{-- Kolom kiri: Gambar/logo Reloka --}}
            <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                <img src="{{ asset('theme/hexashop/assets/images/logorelokabaru.png') }}"
                     alt="Reloka Logo"
                     class="img-fluid rounded shadow-sm"
                     style="max-width: 100%; height: auto;">
            </div>

            {{-- Kolom kanan: Deskripsi tentang Reloka --}}
            <div class="col-lg-6">
                {{-- Judul utama --}}
                <h1 class="fw-bold mb-4" style="font-family: 'Georgia', serif;">
                    Tentang <span class="text-muted">Reloka</span>
                </h1>

                {{-- Paragraf deskripsi 1 --}}
                <p class="lead text-muted mb-3">
                    Reloka adalah rumah bagi pencinta sejarah, seni, dan barang antik berkualitas. Kami menyajikan koleksi langka—dari alat musik klasik, perabot kuno, hingga dokumen bersejarah—yang menyimpan kisah tak ternilai.
                </p>

                {{-- Paragraf deskripsi 2 --}}
                <p class="lead text-muted mb-3">
                    Kami percaya bahwa barang antik bukan sekadar koleksi, melainkan warisan budaya. Nama <em>Reloka</em> berasal dari “relo” (relik) dan “ka” (karya/kisah), mencerminkan misi kami menyambung cerita masa lalu untuk generasi masa kini.
                </p>

                {{-- Paragraf penutup --}}
                <p class="lead text-muted">
                    Temukan keindahan yang abadi—barang antik yang tak hanya unik, tapi juga bermakna.
                </p>

                {{-- Tombol menuju halaman koleksi produk --}}
                <a href="/products" class="btn btn-outline-dark mt-4">Jelajahi Koleksi</a>
            </div>
        </div>
    </div>
</x-layout>
