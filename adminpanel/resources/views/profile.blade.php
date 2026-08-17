@extends('layouts.app')

@section('title', 'Profil')
@section('breadcrumb', 'Profil')

@section('content')
<div class="p-3 sm:p-4" data-testid="profile-page">

    <div class="mb-3">
        <h1 class="ap-h1" data-testid="page-title">Profil</h1>
        <p class="ap-p mt-1.5">Kelola informasi diri, foto, dan kata sandi akun Anda.</p>
    </div>

    @if (session('status'))
        <div class="mb-3 flex items-start gap-2 rounded-md border border-emerald-500/25 bg-emerald-500/10 px-2.5 py-2" data-testid="profile-status">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="mt-px h-3.5 w-3.5 shrink-0 text-emerald-600 dark:text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            <p class="text-[11.5px] font-medium text-emerald-700 dark:text-emerald-300">{{ session('status') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-3 rounded-md border border-red-500/25 bg-red-500/10 px-2.5 py-2" data-testid="profile-errors">
            <p class="text-[11.5px] font-medium text-red-700 dark:text-red-300">Periksa kembali data berikut:</p>
            <ul class="mt-1 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li class="flex items-start gap-1.5 text-[11px] text-red-700/90 dark:text-red-300/80">
                        <span class="mt-[5px] h-1 w-1 shrink-0 rounded-full bg-current"></span>{{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="space-y-3">

        {{-- Informasi diri --}}
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" data-testid="profile-form">
            @csrf
            @method('PUT')

            <x-panel id="identity" title="Informasi diri">
                {{-- Baris identitas --}}
                <div class="flex flex-wrap items-center gap-2.5 border-b border-border pb-2.5">
                    @if ($user->avatar_path)
                        <img src="{{ asset('storage/'.$user->avatar_path) }}" alt="Foto profil" id="apAvatarPreview"
                             class="h-9 w-9 shrink-0 rounded-md border border-border object-cover" data-testid="profile-avatar">
                    @else
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-muted text-[12px] font-semibold text-muted-foreground" id="apAvatarInitials" data-testid="profile-avatar-initials">
                            {{ Str::upper(Str::substr($user->name, 0, 1)) }}
                        </span>
                        <img src="" alt="Pratinjau foto" id="apAvatarPreview" class="hidden h-9 w-9 shrink-0 rounded-md border border-border object-cover">
                    @endif

                    <label class="flex h-7 shrink-0 cursor-pointer items-center gap-1.5 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"/></svg>
                        Unggah foto
                        <input type="file" name="avatar" accept=".jpg,.jpeg,.png,.webp,image/*" class="hidden" onchange="apAvatarPick(this)" data-testid="avatar-input">
                    </label>

                    <span class="min-w-0 flex-1 truncate font-mono text-[9.5px] text-muted-foreground" id="apAvatarName" data-testid="avatar-file-name">
                        {{ $user->avatar_path ? basename($user->avatar_path) : 'JPG, PNG, WebP · maks 2 MB' }}
                    </span>

                    <div class="flex shrink-0 flex-col items-end">
                        <p class="truncate text-[12px] font-semibold leading-tight tracking-tight" data-testid="profile-name">{{ $user->name }}</p>
                        <span class="mt-1 rounded bg-muted px-1.5 py-px font-mono text-[9px] uppercase tracking-[0.1em] text-muted-foreground">administrator</span>
                    </div>
                </div>

                {{-- Kolom data --}}
                <div class="grid grid-cols-1 gap-x-3 gap-y-2.5 sm:grid-cols-2">
                    <div>
                        <label class="ap-label" for="p-name">Nama</label>
                        <input id="p-name" name="name" type="text" required maxlength="255" value="{{ old('name', $user->name) }}" class="ap-input" data-testid="profile-name-input">
                    </div>
                    <div>
                        <label class="ap-label" for="p-email">Email</label>
                        <input id="p-email" name="email" type="email" required maxlength="255" value="{{ old('email', $user->email) }}" class="ap-input" data-testid="profile-email-input">
                    </div>
                    <div>
                        <label class="ap-label" for="p-phone">Telepon</label>
                        <input id="p-phone" name="phone" type="text" maxlength="40" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" class="ap-input">
                    </div>
                    <div>
                        <label class="ap-label" for="p-title">Jabatan</label>
                        <input id="p-title" name="title" type="text" maxlength="120" value="{{ old('title', $user->title) }}" placeholder="mis. Administrator Sistem" class="ap-input" data-testid="profile-title-input">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="ap-label" for="p-bio">Bio</label>
                        <textarea id="p-bio" name="bio" rows="2" maxlength="400" placeholder="Ceritakan peran Anda secara singkat&hellip;"
                                  class="w-full resize-y rounded-md border border-border bg-background px-2 py-1.5 text-[11.5px] leading-relaxed placeholder:text-muted-foreground focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                </div>

                <div class="flex items-start gap-2 rounded-md border border-border bg-muted px-2.5 py-2">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="mt-px h-3.5 w-3.5 shrink-0 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                    <p class="text-[11px] leading-relaxed text-muted-foreground">Nama dan foto yang disimpan langsung dipakai pada bilah atas serta menu akun panel.</p>
                </div>

                <x-slot:footer>
                    <div class="flex items-center gap-1.5">
                        <button type="reset" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium text-muted-foreground transition-colors hover:text-foreground">Reset</button>
                        @if ($user->avatar_path)
                            <button type="submit" form="avatarRemoveForm" data-testid="avatar-remove"
                                    class="h-7 rounded-md px-2 text-[11.5px] font-medium text-red-600 transition-colors hover:bg-red-500/10 dark:text-red-400">Hapus foto</button>
                        @endif
                    </div>
                    <button type="submit" data-testid="profile-submit" class="flex h-7 items-center gap-1.5 rounded-md bg-primary px-2.5 text-[11.5px] font-medium text-primary-foreground transition-opacity hover:opacity-90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9"/></svg>
                        Simpan
                    </button>
                </x-slot:footer>
            </x-panel>
        </form>

        @if ($user->avatar_path)
            <form id="avatarRemoveForm" method="POST" action="{{ route('profile.avatar.destroy') }}" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endif

        {{-- Ubah kata sandi --}}
        <form method="POST" action="{{ route('profile.password.update') }}" data-testid="password-form">
            @csrf
            @method('PUT')

            <x-panel id="password" title="Ubah kata sandi">
                <div class="grid grid-cols-1 gap-x-3 gap-y-2.5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="ap-label" for="p-current">Kata sandi saat ini</label>
                        <div class="relative">
                            <input id="p-current" name="current_password" type="password" required autocomplete="current-password" class="ap-input !pr-8" data-testid="current-password">
                            <button type="button" onclick="apPwEye('p-current')" class="absolute right-1 top-1/2 flex h-5 w-6 -translate-y-1/2 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="ap-label" for="p-new">Kata sandi baru</label>
                        <div class="relative">
                            <input id="p-new" name="password" type="password" required autocomplete="new-password" oninput="apPwMeter(this.value)" placeholder="Minimal 10 karakter" class="ap-input !pr-8" data-testid="new-password">
                            <button type="button" onclick="apPwEye('p-new')" class="absolute right-1 top-1/2 flex h-5 w-6 -translate-y-1/2 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="ap-label" for="p-confirm">Konfirmasi kata sandi</label>
                        <div class="relative">
                            <input id="p-confirm" name="password_confirmation" type="password" required autocomplete="new-password" class="ap-input !pr-8" data-testid="confirm-password">
                            <button type="button" onclick="apPwEye('p-confirm')" class="absolute right-1 top-1/2 flex h-5 w-6 -translate-y-1/2 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="sm:col-span-2 flex items-center gap-1.5">
                        <div class="flex flex-1 gap-1" id="apPwMeterBars">
                            @for ($i = 0; $i < 4; $i++)
                                <span class="h-1 flex-1 rounded-full bg-muted"></span>
                            @endfor
                        </div>
                        <span class="w-16 text-right font-mono text-[9px] uppercase tracking-[0.1em] text-muted-foreground" id="apPwMeterLabel" data-testid="password-strength">kosong</span>
                    </div>
                </div>

                <x-slot:footer>
                    <span class="truncate font-mono text-[9px] uppercase tracking-[0.12em] text-muted-foreground">huruf besar &middot; huruf kecil &middot; angka</span>
                    <button type="submit" data-testid="password-submit" class="flex h-7 items-center gap-1.5 rounded-md bg-primary px-2.5 text-[11.5px] font-medium text-primary-foreground transition-opacity hover:opacity-90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9"/></svg>
                        Simpan
                    </button>
                </x-slot:footer>
            </x-panel>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush
