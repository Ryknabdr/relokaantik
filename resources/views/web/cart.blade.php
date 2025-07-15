<x-layout>
    {{-- Judul halaman --}}
    <x-slot:title>{{ $title }}</x-slot>

        <div class="container mt-5">
            {{-- Card utama --}}
            <div class="card shadow-sm border border-secondary-subtle">
                <div class="card-body">
                    {{-- Judul --}}
                    <h3 class="card-title text-center mb-4 font-serif">🧺 Keranjang Belanja</h3>

                    {{-- Notifikasi berhasil --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Notifikasi gagal --}}
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- Jika ada item di keranjang --}}
                    @if($cart && $cart->items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach($cart->items as $item)
                                        @php
                                            $itemTotal = ($item->itemable->price ?? 0) * $item->quantity;
                                            $total += $itemTotal;
                                        @endphp
                                        <tr>
                                            {{-- Gambar dan nama produk --}}
                                            <td class="d-flex align-items-center">
                                                @if(isset($item->itemable->image))
                                                    <img src="{{ asset('storage/' . $item->itemable->image) }}"
                                                        alt="{{ $item->itemable->name }}" class="rounded me-2"
                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                                <span>{{ $item->itemable->name ?? 'Produk tidak ditemukan' }}</span>
                                            </td>

                                            {{-- Kontrol jumlah produk --}}
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    {{-- Kurangi jumlah --}}
                                                    <form action="{{ route('cart.update', $item->itemable->id) }}" method="POST"
                                                        class="me-1">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="action" value="decrease">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-secondary">−</button>
                                                    </form>
                                                    {{-- Jumlah saat ini --}}
                                                    <span class="px-2">{{ $item->quantity }}</span>
                                                    {{-- Tambah jumlah --}}
                                                    <form action="{{ route('cart.update', $item->itemable->id) }}" method="POST"
                                                        class="ms-1">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="action" value="increase">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-secondary">+</button>
                                                    </form>
                                                </div>
                                            </td>

                                            {{-- Harga satuan --}}
                                            <td>Rp {{ number_format($item->itemable->price ?? 0, 0, ',', '.') }}</td>

                                            {{-- Total harga per item --}}
                                            <td>Rp {{ number_format($itemTotal, 0, ',', '.') }}</td>

                                            {{-- Tombol hapus --}}
                                            <td class="text-center">
                                                <form action="{{ route('cart.remove', $item->itemable->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- Total keseluruhan --}}
                                    <tr class="fw-bold table-secondary">
                                        <td colspan="3" class="text-end">Total</td>
                                        <td colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Tombol Checkout --}}
                        <div class="text-end mt-3">
                            <form action="{{ route('checkout.index') }}" method="GET">
                                <button type="submit" class="btn btn-primary">Lanjut ke Checkout</button>
                            </form>
                        </div>
                    @else
                        {{-- Jika keranjang kosong --}}
                        <div class="text-center p-4">
                            <p class="text-muted">Keranjang belanja Anda kosong.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
</x-layout>