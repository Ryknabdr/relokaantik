<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

// Komponen Livewire Volt anonim untuk mengelola update profil user
new class extends Component {
    // Properti publik untuk nama dan email user
    public string $name = '';
    public string $email = '';

    /**
     * Saat komponen di-mount, ambil data user yang sedang login
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Fungsi untuk mengupdate data profil user saat ini
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        // Validasi input nama dan email
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id) // Email harus unik, kecuali milik user sendiri
            ],
        ]);

        // Isi model user dengan data validasi
        $user->fill($validated);

        // Jika email berubah, reset verifikasi email
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save(); // Simpan perubahan

        // Kirim event agar UI menampilkan notifikasi sukses
        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Kirim ulang email verifikasi jika belum diverifikasi
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        // Jika sudah verifikasi, redirect ke dashboard
        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
};
?>

<section class="w-full">
    {{-- Heading dari layout pengaturan --}}
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        {{-- Form update profil --}}
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            {{-- Input nama --}}
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                {{-- Input email --}}
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                {{-- Jika email belum diverifikasi, tampilkan opsi kirim ulang --}}
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            {{-- Tautan untuk kirim ulang email verifikasi --}}
                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        {{-- Pesan setelah email verifikasi dikirim --}}
                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                {{-- Tombol simpan --}}
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                {{-- Pesan jika profil berhasil diupdate --}}
                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        {{-- Komponen untuk fitur hapus akun --}}
        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
