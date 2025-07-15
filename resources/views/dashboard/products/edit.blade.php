@php
    // Mengimpor facade Storage untuk menampilkan gambar dari penyimpanan
    use Illuminate\Support\Facades\Storage;
@endphp

<x-layouts.app :title="__('Products')"> {{-- Menggunakan layout utama dengan judul Products --}}

    <div class="relative mb-6 w-full">
        {{-- Heading dan subheading halaman --}}
        <flux:heading size="xl">Update Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Products</flux:subheading>
        <flux:separator variant="subtle" /> {{-- Garis pemisah halus --}}
    </div>

    {{-- Menampilkan notifikasi jika ada pesan sukses --}}
    @if(session()->has('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session()->get('successMessage') }}
        </div>

        {{-- Menampilkan notifikasi jika ada pesan error --}}
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{session()->get('errorMessage')}}</flux:badge>
    @endif

    {{-- Form untuk update produk --}}
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @method('patch') {{-- Spoof method PATCH --}}
        @csrf {{-- Token keamanan CSRF --}}

        {{-- Input nama produk --}}
        <flux:input label="Name" name="name" value="{{ $product->name }}" class="mb-3" />

        {{-- Input slug produk --}}
        <flux:input label="Slug" name="slug" value="{{ $product->slug }}" class="mb-3" />

        {{-- Textarea deskripsi produk --}}
        <flux:textarea label="Description" name="description" class="mb-3">{{ $product->description }}</flux:textarea>

        {{-- Input SKU produk --}}
        <flux:input label="SKU" name="sku" value="{{ $product->sku }}" class="mb-3" />

        {{-- Input harga produk --}}
        <flux:input label="Price" name="price" class="mb-3" value="{{ $product->price }}" />

        {{-- Input stok produk --}}
        <flux:input label="Stock" name="stock" class="mb-3" value="{{ $product->stock }}" />

        {{-- Dropdown untuk memilih kategori produk --}}
        <flux:select label="Category" name="product_category_id" class="mb-3">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>

        {{-- Menampilkan gambar lama jika tersedia --}}
        @if($product->image_url)
            <div class="mb-3">
                <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                    class="w-32 h-32 object-cover rounded">
            </div>
        @endif

        {{-- Input file untuk gambar baru --}}
        <flux:input type="file" label="Image" name="image" class="mb-3" />

        {{-- Checkbox untuk status aktif produk --}}
        <label class="mb-6 flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" class="form-checkbox" {{ old('is_active', $product->is_active) ? 'checked' : '' }} />
            <span>Active</span>
        </label>

        <flux:separator variant="subtle" /> {{-- Garis pemisah --}}

        {{-- Tombol Submit dan tombol kembali --}}
        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('products.index') }}" variant="ghost" class="ml-3">Back</flux:link>
        </div>
    </form>
</x-layouts.app>