<x-layout>
    {{-- Menentukan judul halaman --}}
    <x-slot:title>{{ $title }}</x-slot>

    {{-- Wrapper card register --}}
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-sm p-4" style="min-width: 350px; max-width: 400px; width: 100%;">
            <h3 class="mb-4 text-center">Register</h3>

            {{-- Menampilkan pesan error jika ada dari session --}}
            @if(session('errorMessage'))
                <div class="alert alert-danger">
                    {{ session('errorMessage') }}
                </div>
            @endif

            {{-- Form register --}}
            <form method="POST" action="{{ route('customer.store_register') }}">
                @csrf

                {{-- Input: Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name"
                           value="{{ old('name') }}" required autofocus>
                    {{-- Menampilkan error validasi untuk field name --}}
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input: Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input: Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password"
                           value="{{ old('password') }}" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input: Konfirmasi Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           id="password_confirmation" name="password_confirmation"
                           value="{{ old('password_confirmation') }}" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Submit --}}
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>

            {{-- Link ke halaman login --}}
            <div class="mt-3 text-center">
                <small>Sudah memiliki akun? <a href="{{ route('customer.login') }}">Login</a></small>
            </div>
        </div>
    </div>
</x-layout>
