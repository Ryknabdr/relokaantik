<!doctype html>
<html lang="id">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ $title ?? 'Toko Antik Kiwil' }}</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

   {{-- Font klasik elegan --}}
   <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Lora&display=swap"
      rel="stylesheet">

   <style>
      html,
      body {
         height: 100%;
         margin: 0;
      }

      body {
         background: linear-gradient(to bottom, #f5f3eb, #e6d4b7, #c9b29d);
         /* warna gradasi lembut cokelat klasik */
         font-family: 'Lora', serif;
         color: #ede0c8;
         padding-top: 70px;
         display: flex;
         flex-direction: column;
         min-height: 100vh;
         padding-bottom: 0;
      }

      main.container.my-5 {
         background: transparent !important;
         padding: 0 15px !important;
         margin: 0 auto !important;
         max-width: 1140px;
      }

      .input-group input.form-control {
         background-color: #fdf6ee;
         border: 1px solid #c9b29d;
         border-radius: 0.5rem;
      }

      .input-group .btn {
         background-color: #a67c52;
         border-color: #a67c52;
      }

      .input-group .btn:hover {
         background-color: #8b5e3c;
         border-color: #8b5e3c;
      }


      h1,
      h2,
      h3,
      .navbar-brand {
         font-family: 'Playfair Display', serif;
         color: #4b3621;
      }

      .navbar {
         background: linear-gradient(to right, #f1e8d6, #e0ccb1);
         border-bottom: 1px solid #c9b29d;
         font-family: 'Playfair Display', serif;
      }

      .navbar .nav-link {
         color: #4b3621 !important;
         font-weight: 500;
         transition: background-color 0.3s, color 0.3s;
         border-radius: 5px;
      }

      .navbar .nav-link:hover {
         background-color: rgba(185, 150, 108, 0.2);
         color: #3c2f2f !important;
      }

      .navbar a {
         color: #4b3621 !important;
         font-weight: 500;
      }

      .navbar a:hover {
         text-decoration: underline;
      }

      footer {
         background: linear-gradient(135deg, #3b2f2f, #a87954, #f5e9da);
         background-size: 200% 200%;
         background-blend-mode: multiply;
         color: #fff8e1;
         position: static;
         width: 100%;
         flex-shrink: 0;
         font-family: 'Lora', serif;
         box-shadow: inset 0 4px 20px rgba(0, 0, 0, 0.3);
      }

      footer h5,
      footer h6 {
         font-family: 'Playfair Display', serif;
         color: #fff8e1;
         text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
      }

      footer a {
         color: #fff8e1;
         text-decoration: none;
      }

      footer a:hover {
         color: #ffdd94;
         text-decoration: underline;
      }

      footer hr {
         border-top: 1px solid rgba(255, 255, 255, 0.4);
      }

      footer .social-icons i {
         font-size: 20px;
         margin-right: 10px;
         transition: color 0.3s ease;
      }

      footer .social-icons i:hover {
         color: #ffdd94;
      }

      .card {
         border: 1px solid #d6ccc2;
         border-radius: 12px;
         transition: transform 0.3s ease;
      }

      .card:hover {
         transform: scale(1.02);
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      .btn-primary {
         background-color: #a67c52;
         border-color: #a67c52;
      }

      .btn-primary:hover {
         background-color: #8b5e3c;
         border-color: #8b5e3c;
      }

      .section-title {
         font-family: 'Playfair Display', serif;
         font-size: 2rem;
         margin-bottom: 1rem;
         border-bottom: 2px solid #a67c52;
         display: inline-block;
      }

      main.container.my-5 {
         flex: 1 0 auto;
      }
   </style>
   {{ $style ?? '' }}
</head>

<body>

   {{-- Navbar --}}
   <x-navbar themeFolder="{{ $themeFolder }}"></x-navbar>

   {{-- Konten --}}
   <main class="container my-5">
      {{ $slot }}
   </main>

   {{-- Footer --}}
   <footer class="pt-4 pb-4 mt-5">
      <div class="container">
         <div class="row">
            <div class="col-md-5 mb-3">
               <h5 class="fw-bold">RELOKA</h5>
               <p class="small">Temukan keindahan masa lalu dengan koleksi barang antik pilihan dari seluruh Nusantara.
               </p>
               <div class="social-icons mt-3">
                  <a href="https://www.facebook.com/ropik.tempang "><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/rryykkhhnn?igsh=MTRkaTVodG1iM3FjMw=="><i class="bi bi-instagram"></i></a>
                  <a href="https://x.com/AbdurRaihan17?t=YF82hlAGDIrh6KY3GZwSWg&s=09"><i class="bi bi-twitter"></i></a>
                  <a href="https://youtube.com/@abdurraihan5326?si=GMJclYGsAExXk_4d"><i class="bi bi-youtube"></i></a>
               </div>
            </div>
            <div class="col-md-4 mb-3">
               <h6>Navigasi</h6>
               <ul class="list-unstyled small">
                  <li><a href="#">Beranda</a></li>
                  <li><a href="#">Produk</a></li>
                  <li><a href="#">Kategori</a></li>
                  <li><a href="#">Tentang Kami</a></li>
                  <li><a href="#">Kontak</a></li>
               </ul>
            </div>
            <div class="col-md-3 mb-3">
               <h6>Kontak Kami</h6>
               <ul class="list-unstyled small">
                  <li><i class="bi bi-envelope"></i> info@relokaantik.com</li>
                  <li><i class="bi bi-telephone"></i> +62 856 6100 994</li>
                  <li><i class="bi bi-geo-alt"></i> Tegal, Indonesia</li>
               </ul>
            </div>
         </div>
         <hr class="my-3">
         <div class="text-center">
            <small>© {{ date('Y') }} Toko Antik Reloka. Hak cipta dilindungi.</small>
         </div>
      </div>
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>