<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

// Komponen Livewire untuk memperbarui password pengguna yang sedang login
new class extends Component {
    public string $current_password = ''; // Input password saat ini
    public string $password = ''; // Input password baru
    public string $password_confirmation = ''; // Konfirmasi password baru

    /**
     * Fungsi untuk memperbarui password pengguna
     */
    public function updatePassword(): void
    {
        try {
            // Validasi input form
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'], // Validasi password lama
                'password' => ['required', 'string', Password::defaults(), 'confirmed'], // Password baru harus dikonfirmasi
            ]);
        } catch (ValidationException $e) {
            // Reset input jika validasi gagal, lalu lempar kembali exception
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        // Update password user dengan hash baru
        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Reset input form
        $this->reset('current_password', 'password', 'password_confirmation');

        // Dispatch event ke frontend untuk menampilkan notifikasi sukses
        $this->dispatch('password-updated');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    {{-- Komponen layout pengaturan dengan judul dan subjudul --}}
    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            {{-- Input untuk password saat ini --}}
            <flux:input wire:model="current_password" :label="__('Current password')" type="password" required
                autocomplete="current-password" />

            {{-- Input untuk password baru --}}
            <flux:input wire:model="password" :label="__('New password')" type="password" required
                autocomplete="new-password" />

            {{-- Input untuk konfirmasi password baru --}}
            <flux:input wire:model="password_confirmation" :label="__('Confirm Password')" type="password" required
                autocomplete="new-password" />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    {{-- Tombol submit untuk menyimpan perubahan --}}
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                {{-- Pesan aksi yang ditampilkan saat password berhasil diupdate --}}
                <x-action-message class="me-3" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>