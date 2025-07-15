@php
    // Menggunakan facade Storage, meskipun tidak digunakan langsung di view ini
    use Illuminate\Support\Facades\Storage;
@endphp

<x-layouts.app :title="__('Products')"> {{-- Menggunakan layout utama dengan judul halaman 'Products' --}}
    
    <div class="relative mb-6 w-full">
        {{-- Heading dan subheading halaman --}}
        <flux:heading size="xl">Add New Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Products</flux:subheading>
        <flux:separator variant="subtle" /> {{-- Garis pemisah visual --}}
    </div>

    {{-- Menampilkan pesan sukses jika ada --}}
    @if(session()->has('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session()->get('successMessage') }}
        </div>
    
    {{-- Menampilkan pesan error jika ada --}}
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{session()->get('errorMessage')}}</flux:badge>
    @endif

    {{-- Form untuk menyimpan produk baru --}}
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf {{-- Token keamanan CSRF --}}

        {{-- Input nama produk --}}
        <flux:input label="Name" name="name" value="{{ old('name') }}" class="mb-3" />

        {{-- Input slug produk --}}
        <flux:input label="Slug" name="slug" value="{{ old('slug') }}" class="mb-3" />

        {{-- Textarea deskripsi produk --}}
        <flux:textarea label="Description" name="description" class="mb-3">{{ old('description') }}</flux:textarea>

        {{-- Input SKU produk --}}
        <flux:input label="SKU" name="sku" value="{{ old('sku') }}" class="mb-3" />

        {{-- Input harga produk --}}
        <flux:input label="Price" name="price" class="mb-3" value="{{ old('price') }}" />

        {{-- Input stok produk --}}
        <flux:input label="Stock" name="stock" class="mb-3" value="{{ old('stock') }}" />

        {{-- Dropdown untuk memilih kategori produk --}}
        <flux:select label="Category" name="product_category_id" class="mb-3">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>

        {{-- Input untuk upload gambar produk --}}
        <flux:input type="file" label="Image" name="image" class="mb-3" />

        {{-- Checkbox untuk menandai apakah produk aktif --}}
        <label class="mb-6 flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" class="form-checkbox" {{ old('is_active', true) ? 'checked' : '' }} />
            <span>Active</span>
        </label>

        <flux:separator variant="subtle" /> {{-- Garis pemisah visual --}}

        {{-- Tombol submit dan tombol kembali --}}
        <div class="mt-4">
            <flux:button type="submit" variant="primary">Save</flux:button>
            <flux:link href="{{ route('products.index') }}" variant="ghost" class="ml-3">Back</flux:link>
        </div>
    </form>
</x-layouts.app>
