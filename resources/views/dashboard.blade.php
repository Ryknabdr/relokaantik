<x-layouts.app :title="__('Dashboard')">
    {{-- Wrapper utama konten dashboard --}}
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        {{-- Kartu ringkasan statistik: Total Produk, Kategori, dan Pesanan --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            {{-- Kartu Total Produk --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-yellow-700 dark:border-yellow-500 p-6 flex flex-col justify-center items-center bg-yellow-50 dark:bg-yellow-900 shadow-lg">
                <h2 class="text-2xl font-semibold text-yellow-900 dark:text-yellow-300">Total Produk</h2>
                <p class="mt-4 text-4xl font-bold text-yellow-700 dark:text-yellow-400">{{ $productCount }}</p>
            </div>

            {{-- Kartu Total Kategori --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-green-700 dark:border-green-500 p-6 flex flex-col justify-center items-center bg-green-50 dark:bg-green-900 shadow-lg">
                <h2 class="text-2xl font-semibold text-green-900 dark:text-green-300">Total Kategori</h2>
                <p class="mt-4 text-4xl font-bold text-green-700 dark:text-green-400">{{ $categoryCount }}</p>
            </div>

            {{-- Kartu Total Pesanan --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-purple-700 dark:border-purple-500 p-6 flex flex-col justify-center items-center bg-purple-50 dark:bg-purple-900 shadow-lg">
                <h2 class="text-2xl font-semibold text-purple-900 dark:text-purple-300">Total Pesanan</h2>
                <p class="mt-4 text-4xl font-bold text-purple-700 dark:text-purple-400">{{ $orderCount }}</p>
            </div>
        </div>

        {{-- Panel sambutan admin --}}
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-6 p-6 bg-white dark:bg-gray-800 shadow">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Selamat datang di Dashboard Admin Koleksi Barang Antik</h3>
            <p class="text-gray-600 dark:text-gray-400">Gunakan menu di sebelah kiri untuk mengelola kategori, produk, dan pesanan koleksi barang antik Anda.</p>
        </div>
    </div>
</x-layouts.app>
