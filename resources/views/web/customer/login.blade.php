<x-layout>
    {{-- Judul halaman --}}
    <x-slot:title>{{ $title }}</x-slot>

    {{-- Container form login --}}
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-sm p-4" style="min-width: 350px; max-width: 400px; width: 100%;">
            <h3 class="mb-4 text-center">Login</h3>

            {{-- Menampilkan pesan error dari session (jika login gagal) --}}
            @if(session('errorMessage'))
                <div class="alert alert-danger">
                    {{ session('errorMessage') }}
                </div>
            @endif

            {{-- Menampilkan pesan sukses dari session (misalnya setelah register berhasil) --}}
            @if(session('successMessage'))
                <div class="alert alert-success">
                    {{ session('successMessage') }}
                </div>
            @endif

            {{-- Form login --}}
            <form method="POST" action="{{ route('customer.login') }}">
                @csrf

                {{-- Input Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Checkbox Remember Me --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                {{-- Tombol Submit --}}
                <button type="submit" class="btn btn-primary w-100">Login</button>

                {{-- Link ke halaman register --}}
                <div class="mt-3 text-center">
                    <small>
                        Belum punya akun?
                        <a href="{{ route('customer.register') }}">Daftar disini</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
</x-layout>
