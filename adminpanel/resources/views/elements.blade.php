@extends('layouts.app')

@section('title', 'Elements')
@section('breadcrumb', 'Elements')

@php
    $sections = [
        'inputs' => 'Inputs', 'sizes' => 'Sizes', 'addons' => 'Input groups', 'validation' => 'Validation',
        'floating' => 'Floating label', 'password' => 'Password', 'textarea' => 'Textarea', 'selects' => 'Selects',
        'searchable' => 'Searchable select',
        'checks' => 'Checkbox &amp; radio', 'switches' => 'Switches', 'cards' => 'Choice cards', 'range' => 'Range',
        'stepper' => 'Stepper', 'otp' => 'OTP', 'files' => 'File &amp; dropzone', 'datetime' => 'Date &amp; time',
        'color' => 'Color', 'tags' => 'Tags input', 'search' => 'Autocomplete', 'layout' => 'Form layout',
    ];
@endphp

@section('content')
<div class="p-3 sm:p-4" data-testid="elements-page">

    <div class="mb-3">
        <h1 class="ap-h1" data-testid="page-title">Elements</h1>
        <p class="ap-p mt-1.5">Kumpulan elemen formulir siap pakai &mdash; tinggi kontrol 28px, label mono 10px.</p>
    </div>

    <div class="mb-3 flex flex-wrap gap-1" data-testid="section-index">
        @foreach ($sections as $id => $label)
            <a href="#{{ $id }}" class="rounded border border-border bg-surface px-1.5 py-[3px] font-mono text-[9.5px] uppercase tracking-[0.1em] text-muted-foreground transition-colors hover:border-accent/50 hover:text-foreground">{!! $label !!}</a>
        @endforeach
    </div>

    <form onsubmit="event.preventDefault(); apToast('Formulir dikirim (demo).', 'emerald');" data-testid="elements-form">
    <div class="grid grid-cols-1 items-start gap-3 xl:grid-cols-2">

        {{-- Inputs --}}
        <x-panel id="inputs" title="Inputs" hint="h-7 &middot; 11.5px">
            <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                <div>
                    <label class="ap-label" for="e-name">Teks</label>
                    <input id="e-name" type="text" placeholder="Admin Root" class="ap-input" data-testid="input-text">
                </div>
                <div>
                    <label class="ap-label" for="e-email">Email</label>
                    <div class="relative">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="ap-input-icon"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 9.409a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                        <input id="e-email" type="email" placeholder="admin@nexus.local" class="ap-input !pl-7">
                    </div>
                </div>
                <div>
                    <label class="ap-label" for="e-num">Angka</label>
                    <input id="e-num" type="number" value="24" class="ap-input">
                </div>
                <div>
                    <label class="ap-label" for="e-ro">Hanya baca</label>
                    <input id="e-ro" type="text" value="nexus-prod-01" readonly class="ap-input cursor-default !bg-muted !text-muted-foreground">
                </div>
                <div>
                    <label class="ap-label" for="e-dis">Nonaktif</label>
                    <input id="e-dis" type="text" value="Tidak dapat diubah" disabled class="ap-input cursor-not-allowed !bg-muted !text-muted-foreground opacity-60">
                </div>
                <div>
                    <label class="ap-label" for="e-copy">Dengan aksi salin</label>
                    <div class="relative">
                        <input id="e-copy" type="text" value="sk_live_9f2c7a1b" readonly class="ap-input !pr-8 font-mono !text-[10.5px]">
                        <button type="button" onclick="apCopy('e-copy')" data-testid="copy-btn" class="absolute right-1 top-1/2 flex h-5 w-6 -translate-y-1/2 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3 w-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75m10.5 8.25h1.875c.621 0 1.125-.504 1.125-1.125V4.125c0-.621-.504-1.125-1.125-1.125H9.375c-.621 0-1.125.504-1.125 1.125V13.5c0 .621.504 1.125 1.125 1.125H12"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            <p class="ap-help">Placeholder memakai warna muted, teks isi memakai foreground penuh.</p>
        </x-panel>

        {{-- Sizes --}}
        <x-panel id="sizes" title="Sizes" hint="xs 24 &middot; sm 28 &middot; md 32">
            <div class="space-y-2">
                <input type="text" placeholder="Extra small &middot; h-6 &middot; 10.5px" class="h-6 w-full rounded border border-border bg-background px-1.5 text-[10.5px] placeholder:text-muted-foreground focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40">
                <input type="text" placeholder="Small (default) &middot; h-7 &middot; 11.5px" class="ap-input">
                <input type="text" placeholder="Medium &middot; h-8 &middot; 12px" class="h-8 w-full rounded-md border border-border bg-background px-2.5 text-[12px] placeholder:text-muted-foreground focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40">
            </div>
            <div class="flex flex-wrap items-center gap-1.5">
                <input type="text" placeholder="Sisipan kanan" class="ap-input !w-40">
                <button type="button" class="h-7 rounded-md bg-primary px-2.5 text-[11.5px] font-medium text-primary-foreground">Terapkan</button>
            </div>
        </x-panel>

        {{-- Input groups --}}
        <x-panel id="addons" title="Input groups">
            <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                <div>
                    <label class="ap-label">Prefix teks</label>
                    <div class="flex">
                        <span class="flex h-7 items-center rounded-l-md border border-r-0 border-border bg-muted px-2 font-mono text-[10.5px] text-muted-foreground">https://</span>
                        <input type="text" value="nexus.local" class="ap-input !rounded-l-none">
                    </div>
                </div>
                <div>
                    <label class="ap-label">Suffix teks</label>
                    <div class="flex">
                        <input type="text" value="1200" class="ap-input !rounded-r-none">
                        <span class="flex h-7 items-center rounded-r-md border border-l-0 border-border bg-muted px-2 font-mono text-[10.5px] text-muted-foreground">px</span>
                    </div>
                </div>
                <div>
                    <label class="ap-label">Prefix mata uang</label>
                    <div class="flex">
                        <span class="flex h-7 items-center rounded-l-md border border-r-0 border-border bg-muted px-2 text-[11px] text-muted-foreground">Rp</span>
                        <input type="text" value="149.000" class="ap-input !rounded-l-none">
                        <select class="h-7 rounded-r-md border border-l-0 border-border bg-muted px-1.5 text-[11px] text-muted-foreground focus:outline-none">
                            <option>IDR</option><option>USD</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="ap-label">Dengan tombol</label>
                    <div class="flex">
                        <input type="text" placeholder="Cari pengguna" class="ap-input !rounded-r-none">
                        <button type="button" class="flex h-7 items-center rounded-r-md border border-l-0 border-border bg-muted px-2 text-[11px] font-medium transition-colors hover:bg-border">Cari</button>
                    </div>
                </div>
            </div>
        </x-panel>

        {{-- Validation --}}
        <x-panel id="validation" title="Validation states">
            <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-3">
                <div>
                    <label class="ap-label">Valid</label>
                    <div class="relative">
                        <input type="text" value="admin@nexus.local" class="h-7 w-full rounded-md border border-emerald-500/60 bg-background pr-7 pl-2 text-[11.5px] focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500/30">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" class="pointer-events-none absolute right-2 top-1/2 h-3 w-3 -translate-y-1/2 text-emerald-500"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                    </div>
                    <p class="mt-1 text-[10px] text-emerald-600 dark:text-emerald-400">Email tersedia.</p>
                </div>
                <div>
                    <label class="ap-label">Peringatan</label>
                    <input type="text" value="nexus" class="h-7 w-full rounded-md border border-amber-500/60 bg-background px-2 text-[11.5px] focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500/30">
                    <p class="mt-1 text-[10px] text-amber-600 dark:text-amber-400">Terlalu umum, tambahkan angka.</p>
                </div>
                <div>
                    <label class="ap-label">Tidak valid</label>
                    <div class="relative">
                        <input type="text" value="admin@" class="h-7 w-full rounded-md border border-red-500/60 bg-background pr-7 pl-2 text-[11.5px] focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500/30" data-testid="input-invalid">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" class="pointer-events-none absolute right-2 top-1/2 h-3 w-3 -translate-y-1/2 text-red-500"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </div>
                    <p class="mt-1 text-[10px] text-red-600 dark:text-red-400" data-testid="error-message">Format email tidak valid.</p>
                </div>
            </div>
        </x-panel>

        {{-- Floating label --}}
        <x-panel id="floating" title="Floating label">
            <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                <div class="relative">
                    <input id="f1" type="text" placeholder=" " class="peer h-9 w-full rounded-md border border-border bg-background px-2 pt-3 text-[11.5px] focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40">
                    <label for="f1" class="pointer-events-none absolute left-2 top-1/2 -translate-y-1/2 font-mono text-[10px] uppercase tracking-[0.1em] text-muted-foreground transition-all peer-focus:top-[9px] peer-focus:text-[8.5px] peer-[:not(:placeholder-shown)]:top-[9px] peer-[:not(:placeholder-shown)]:text-[8.5px]">Nama lengkap</label>
                </div>
                <div class="relative">
                    <input id="f2" type="text" value="Nexus HQ" placeholder=" " class="peer h-9 w-full rounded-md border border-border bg-background px-2 pt-3 text-[11.5px] focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40">
                    <label for="f2" class="pointer-events-none absolute left-2 top-[9px] font-mono text-[8.5px] uppercase tracking-[0.1em] text-muted-foreground">Organisasi</label>
                </div>
            </div>
        </x-panel>

        {{-- Password --}}
        <x-panel id="password" title="Password">
            <div>
                <label class="ap-label" for="e-pw">Kata sandi baru</label>
                <div class="relative">
                    <input id="e-pw" type="password" oninput="apStrength(this.value)" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" class="ap-input !pr-8" data-testid="input-password">
                    <button type="button" onclick="apPwToggle('e-pw', this)" data-testid="pw-toggle" class="absolute right-1 top-1/2 flex h-5 w-6 -translate-y-1/2 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    </button>
                </div>
            </div>
            <div class="flex items-center gap-1.5">
                <div class="flex flex-1 gap-1" id="apPwBars">
                    @for ($i = 0; $i < 4; $i++)
                        <span class="h-1 flex-1 rounded-full bg-muted"></span>
                    @endfor
                </div>
                <span class="w-16 text-right font-mono text-[9px] uppercase tracking-[0.1em] text-muted-foreground" id="apPwLabel" data-testid="pw-strength">kosong</span>
            </div>
            <p class="ap-help">Minimal 8 karakter, kombinasikan huruf besar, angka, dan simbol.</p>
        </x-panel>

        {{-- Textarea --}}
        <x-panel id="textarea" title="Textarea">
            <div>
                <label class="ap-label" for="e-ta">Catatan</label>
                <textarea id="e-ta" rows="3" maxlength="180" oninput="apCount(this)" placeholder="Tulis catatan internal&hellip;" class="w-full resize-y rounded-md border border-border bg-background px-2 py-1.5 text-[11.5px] leading-relaxed placeholder:text-muted-foreground focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40" data-testid="textarea"></textarea>
                <div class="mt-1 flex items-center justify-between">
                    <p class="ap-help">Shift + Enter untuk baris baru.</p>
                    <span class="font-mono text-[9px] text-muted-foreground" data-testid="char-count">0 / 180</span>
                </div>
            </div>
        </x-panel>

        {{-- Selects --}}
        <x-panel id="selects" title="Selects">
            <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                <div>
                    <label class="ap-label" for="e-sel">Peran</label>
                    <select id="e-sel" class="ap-input appearance-none !pr-6" data-testid="select-role"
                            style="background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 stroke=%22%2371717A%22 stroke-width=%222%22 viewBox=%220 0 24 24%22><path d=%22m19.5 8.25-7.5 7.5-7.5-7.5%22/></svg>');background-repeat:no-repeat;background-position:right 6px center">
                        <option>Owner</option><option selected>Editor</option><option>Viewer</option>
                    </select>
                </div>
                <div>
                    <label class="ap-label" for="e-sel2">Dengan grup</label>
                    <select id="e-sel2" class="ap-input">
                        <optgroup label="Produksi"><option>nexus-prod-01</option><option>nexus-prod-02</option></optgroup>
                        <optgroup label="Staging"><option>nexus-stg-01</option></optgroup>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="ap-label" for="e-multi">Multi select</label>
                    <select id="e-multi" multiple size="4" class="w-full rounded-md border border-border bg-background px-1 py-1 text-[11.5px] focus:border-accent focus:outline-none">
                        @foreach (['Dashboard', 'Pengguna', 'Pesanan', 'Laporan', 'Integrasi'] as $i => $opt)
                            <option class="rounded px-1 py-0.5" {{ $i < 2 ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                    <p class="ap-help mt-1">Tahan Ctrl / Cmd untuk memilih beberapa.</p>
                </div>
            </div>
        </x-panel>

        {{-- Searchable select (select2 tanpa paket) --}}
        <x-panel id="searchable" title="Searchable select" hint="select2 &middot; tanpa paket">
            @php
                $servers = ['nexus-prod-01', 'nexus-prod-02', 'nexus-prod-03', 'nexus-stg-01', 'nexus-stg-02', 'nexus-dev-01', 'nexus-edge-sg', 'nexus-edge-jkt'];
                $people = [['Admin Root', 'admin@nexus.local'], ['Bima Kurniawan', 'bima@nexus.local'], ['Citra Maharani', 'citra@nexus.local'], ['Dimas Prakoso', 'dimas@nexus.local'], ['Eka Wulandari', 'eka@nexus.local'], ['Fajar Nugroho', 'fajar@nexus.local']];
            @endphp

            {{-- Single --}}
            <div class="relative">
                <label class="ap-label">Pilihan tunggal dengan pencarian</label>
                <button type="button" onclick="apSelToggle(event, 'ss')" data-testid="ss-trigger"
                        class="flex h-7 w-full items-center gap-1.5 rounded-md border border-border bg-background px-2 text-left text-[11.5px] transition-colors hover:border-accent/50 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5 shrink-0 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 0 1-3-3m3 3a3 3 0 1 0 0-6h13.5a3 3 0 0 1 0 6m-16.5-3a3 3 0 0 1 3-3h13.5m0 0a3 3 0 1 1 0 6m-16.5 3h13.5a3 3 0 0 1 0 6H5.25a3 3 0 0 1 0-6Z"/></svg>
                    <span class="min-w-0 flex-1 truncate font-mono text-[10.5px]" id="ss-label" data-testid="ss-value">nexus-prod-01</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3 shrink-0 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                </button>

                <div id="ss" class="ap-sel absolute left-0 right-0 top-[46px] z-40 hidden overflow-hidden rounded-lg border border-border bg-elevated shadow-xl shadow-black/10" data-testid="ss-menu">
                    <div class="relative border-b border-border">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="pointer-events-none absolute left-2 top-1/2 h-3 w-3 -translate-y-1/2 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                        <input type="text" placeholder="Cari server&hellip;" oninput="apSelFilter('ss', this.value)" onkeydown="apSelKey(event, 'ss')"
                               class="h-7 w-full bg-transparent pl-7 pr-2 text-[11.5px] placeholder:text-muted-foreground focus:outline-none" data-testid="ss-search">
                    </div>
                    <div class="scroll-thin max-h-36 overflow-y-auto p-1" data-testid="ss-options">
                        @foreach ($servers as $i => $srv)
                            <button type="button" onclick="apSelPick('ss', this)" data-label="{{ $srv }}" data-testid="ss-option-{{ $i }}"
                                    class="ap-sel-opt flex h-7 w-full items-center justify-between gap-2 rounded px-2 text-left font-mono text-[10.5px] transition-colors hover:bg-muted {{ $i === 0 ? 'bg-muted text-foreground' : 'text-muted-foreground' }}">
                                <span class="truncate">{{ $srv }}</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" class="ap-sel-check h-3 w-3 shrink-0 text-accent {{ $i === 0 ? '' : 'hidden' }}"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            </button>
                        @endforeach
                        <p class="hidden px-2 py-1.5 text-[11px] text-muted-foreground" data-testid="ss-empty">Tidak ada hasil.</p>
                    </div>
                </div>
            </div>

            {{-- Multi --}}
            <div class="relative">
                <label class="ap-label">Pilihan ganda dengan pencarian</label>
                <div onclick="apSelToggle(event, 'ms')" data-testid="ms-trigger"
                     class="flex min-h-7 cursor-pointer flex-wrap items-center gap-1 rounded-md border border-border bg-background p-1 transition-colors hover:border-accent/50">
                    <div class="flex flex-wrap items-center gap-1" id="ms-chips" data-testid="ms-chips"></div>
                    <span class="flex-1 px-1 text-[11.5px] text-muted-foreground" id="ms-placeholder">Pilih anggota tim&hellip;</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-1 h-3 w-3 shrink-0 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                </div>

                <div id="ms" class="ap-sel absolute left-0 right-0 top-[46px] z-40 hidden overflow-hidden rounded-lg border border-border bg-elevated shadow-xl shadow-black/10" data-testid="ms-menu">
                    <div class="relative border-b border-border">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="pointer-events-none absolute left-2 top-1/2 h-3 w-3 -translate-y-1/2 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                        <input type="text" placeholder="Cari nama atau email&hellip;" oninput="apSelFilter('ms', this.value)"
                               class="h-7 w-full bg-transparent pl-7 pr-2 text-[11.5px] placeholder:text-muted-foreground focus:outline-none" data-testid="ms-search">
                    </div>
                    <div class="scroll-thin max-h-36 overflow-y-auto p-1" data-testid="ms-options">
                        @foreach ($people as $i => [$name, $mail])
                            <button type="button" onclick="apMsPick(this)" data-label="{{ $name }} {{ $mail }}" data-name="{{ $name }}" data-testid="ms-option-{{ $i }}"
                                    class="ap-sel-opt flex h-8 w-full items-center gap-2 rounded px-2 text-left transition-colors hover:bg-muted">
                                <span class="ap-ms-box flex h-3 w-3 shrink-0 items-center justify-center rounded border border-border">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="ap-sel-check hidden h-2 w-2 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                </span>
                                <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded bg-muted text-[8.5px] font-semibold text-muted-foreground">{{ Str::upper(Str::substr($name, 0, 2)) }}</span>
                                <span class="min-w-0 flex-1 truncate text-[11.5px] font-medium">{{ $name }}</span>
                                <span class="hidden shrink-0 font-mono text-[9px] text-muted-foreground sm:block">{{ $mail }}</span>
                            </button>
                        @endforeach
                        <p class="hidden px-2 py-1.5 text-[11px] text-muted-foreground" data-testid="ms-empty">Tidak ada hasil.</p>
                    </div>
                    <div class="flex items-center justify-between border-t border-border bg-muted px-2 py-1.5">
                        <span class="font-mono text-[9px] uppercase tracking-[0.12em] text-muted-foreground" id="ms-count" data-testid="ms-count">0 dipilih</span>
                        <button type="button" onclick="apMsClear(event)" data-testid="ms-clear" class="text-[10.5px] font-medium text-muted-foreground transition-colors hover:text-foreground">Kosongkan</button>
                    </div>
                </div>
            </div>

            <p class="ap-help">Pencarian, keyboard (&uarr;&darr; Enter Esc), dan multi-pilih dibuat dengan JS biasa &mdash; tanpa Select2 atau jQuery.</p>
        </x-panel>

        {{-- Checkbox & radio --}}
        <x-panel id="checks" title="Checkbox &amp; radio">
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div class="space-y-1.5">
                    <p class="ap-label">Izin</p>
                    @foreach ([['Baca', true, false], ['Tulis', true, false], ['Hapus', false, false], ['Kelola billing', false, true]] as [$label, $checked, $disabled])
                        <label class="flex items-center gap-2 text-[11.5px] {{ $disabled ? 'cursor-not-allowed opacity-50' : 'cursor-pointer' }}">
                            <input type="checkbox" {{ $checked ? 'checked' : '' }} {{ $disabled ? 'disabled' : '' }} class="h-3.5 w-3.5 rounded border-border bg-background text-accent focus:ring-1 focus:ring-accent/40" data-testid="checkbox-{{ Str::slug($label) }}">
                            {{ $label }}
                        </label>
                    @endforeach
                    <label class="flex cursor-pointer items-center gap-2 text-[11.5px]">
                        <input type="checkbox" indeterminate class="h-3.5 w-3.5 rounded border-border bg-background text-accent" onclick="this.indeterminate=false">
                        <span class="text-muted-foreground">Sebagian terpilih</span>
                    </label>
                </div>
                <div class="space-y-1.5">
                    <p class="ap-label">Visibilitas</p>
                    @foreach ([['Publik', true], ['Terbatas', false], ['Privat', false]] as [$label, $checked])
                        <label class="flex cursor-pointer items-center gap-2 text-[11.5px]">
                            <input type="radio" name="vis" {{ $checked ? 'checked' : '' }} class="h-3.5 w-3.5 border-border bg-background text-accent focus:ring-1 focus:ring-accent/40" data-testid="radio-{{ Str::slug($label) }}">
                            {{ $label }}
                        </label>
                    @endforeach
                    <label class="flex cursor-not-allowed items-center gap-2 text-[11.5px] opacity-50">
                        <input type="radio" name="vis" disabled class="h-3.5 w-3.5 border-border bg-background">
                        Warisan organisasi
                    </label>
                </div>
            </div>
        </x-panel>

        {{-- Switches --}}
        <x-panel id="switches" title="Switches">
            <div class="divide-y divide-border rounded-md border border-border">
                @foreach ([['Notifikasi email', 'Kirim ringkasan harian ke inbox.', true], ['Autentikasi dua faktor', 'Wajibkan kode OTP saat masuk.', false], ['Mode pemeliharaan', 'Tutup akses publik sementara.', false]] as $i => [$title, $desc, $on])
                    <label class="flex cursor-pointer items-center gap-2.5 px-2.5 py-2 transition-colors hover:bg-muted">
                        <div class="min-w-0 flex-1">
                            <p class="text-[11.5px] font-medium leading-tight">{{ $title }}</p>
                            <p class="mt-0.5 text-[10.5px] text-muted-foreground">{{ $desc }}</p>
                        </div>
                        <span class="relative inline-flex shrink-0">
                            <input type="checkbox" {{ $on ? 'checked' : '' }} class="peer sr-only" data-testid="switch-{{ $i }}">
                            <span class="h-4 w-7 rounded-full bg-border transition-colors peer-checked:bg-accent"></span>
                            <span class="absolute left-0.5 top-0.5 h-3 w-3 rounded-full bg-white transition-transform peer-checked:translate-x-3"></span>
                        </span>
                    </label>
                @endforeach
            </div>
        </x-panel>

        {{-- Choice cards --}}
        <x-panel id="cards" title="Choice cards">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                @foreach ([['Starter', 'Rp 0', '1 proyek', false], ['Pro', 'Rp 149rb', '10 proyek', true], ['Skala', 'Rp 499rb', 'Tanpa batas', false]] as $i => [$plan, $price, $desc, $on])
                    <label class="cursor-pointer">
                        <input type="radio" name="plan" {{ $on ? 'checked' : '' }} class="peer sr-only" data-testid="plan-{{ Str::slug($plan) }}">
                        <div class="rounded-md border border-border bg-surface p-2.5 transition-all peer-checked:border-accent peer-checked:ring-1 peer-checked:ring-accent/40 hover:border-accent/50">
                            <div class="flex items-center justify-between">
                                <p class="text-[11.5px] font-semibold tracking-tight">{{ $plan }}</p>
                                <span class="flex h-3 w-3 items-center justify-center rounded-full border border-border peer-checked:border-accent"></span>
                            </div>
                            <p class="mt-1.5 text-[13px] font-semibold leading-none tracking-tight">{{ $price }}</p>
                            <p class="mt-1 text-[10.5px] text-muted-foreground">{{ $desc }}</p>
                        </div>
                    </label>
                @endforeach
            </div>
            <div class="flex flex-wrap gap-1.5">
                @foreach (['Semua', 'Aktif', 'Diarsipkan', 'Dihapus'] as $i => $chip)
                    <label class="cursor-pointer">
                        <input type="radio" name="chip" {{ $i === 1 ? 'checked' : '' }} class="peer sr-only">
                        <span class="block rounded-full border border-border px-2 py-[3px] text-[10.5px] font-medium text-muted-foreground transition-colors peer-checked:border-transparent peer-checked:bg-primary peer-checked:text-primary-foreground hover:text-foreground">{{ $chip }}</span>
                    </label>
                @endforeach
            </div>
        </x-panel>

        {{-- Range --}}
        <x-panel id="range" title="Range">
            <div>
                <div class="mb-1.5 flex items-center justify-between">
                    <label class="ap-label mb-0" for="e-range">Batas unggahan</label>
                    <span class="font-mono text-[9.5px] text-muted-foreground" id="apRangeVal" data-testid="range-value">40 MB</span>
                </div>
                <input id="e-range" type="range" min="1" max="100" value="40" oninput="document.getElementById('apRangeVal').textContent = this.value + ' MB'"
                       class="h-1 w-full cursor-pointer appearance-none rounded-full bg-muted accent-accent" data-testid="range-input">
            </div>
            <div>
                <div class="mb-1.5 flex items-center justify-between">
                    <label class="ap-label mb-0">Kompresi</label>
                    <span class="font-mono text-[9.5px] text-muted-foreground" id="apRangeVal2">72%</span>
                </div>
                <input type="range" min="0" max="100" value="72" oninput="document.getElementById('apRangeVal2').textContent = this.value + '%'"
                       class="h-1 w-full cursor-pointer appearance-none rounded-full bg-muted accent-emerald-500">
            </div>
        </x-panel>

        {{-- Stepper --}}
        <x-panel id="stepper" title="Stepper">
            <div class="flex flex-wrap items-end gap-2.5 sm:gap-3">
                <div>
                    <label class="ap-label">Jumlah</label>
                    <div class="inline-flex overflow-hidden rounded-md border border-border">
                        <button type="button" onclick="apStep(-1)" data-testid="step-minus" class="flex h-7 w-7 items-center justify-center border-r border-border bg-surface text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="h-3 w-3"><path stroke-linecap="round" d="M19.5 12h-15"/></svg>
                        </button>
                        <input id="apQty" type="text" value="3" readonly class="h-7 w-10 bg-background text-center font-mono text-[11.5px] focus:outline-none" data-testid="step-value">
                        <button type="button" onclick="apStep(1)" data-testid="step-plus" class="flex h-7 w-7 items-center justify-center border-l border-border bg-surface text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="h-3 w-3"><path stroke-linecap="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="ap-label">Toggle grup</label>
                    <div class="inline-flex overflow-hidden rounded-md border border-border">
                        @foreach (['Kiri', 'Tengah', 'Kanan'] as $i => $al)
                            <button type="button" onclick="apGroup(this)" class="ap-group h-7 border-r border-border px-2 text-[11px] font-medium transition-colors last:border-r-0 {{ $i === 0 ? 'bg-primary text-primary-foreground' : 'bg-surface text-muted-foreground hover:bg-muted' }}">{{ $al }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-panel>

        {{-- OTP --}}
        <x-panel id="otp" title="OTP input">
            <div class="flex flex-wrap items-center gap-1.5" data-testid="otp-group">
                @for ($i = 0; $i < 6; $i++)
                    <input type="text" maxlength="1" inputmode="numeric" oninput="apOtp(this)"
                           class="ap-otp h-8 w-7 rounded-md border border-border bg-background text-center font-mono text-[12px] focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40"
                           data-testid="otp-{{ $i }}">
                    @if ($i === 2)
                        <span class="text-muted-foreground">&ndash;</span>
                    @endif
                @endfor
            </div>
            <p class="ap-help">Kode 6 digit dikirim ke email admin. Berlaku 5 menit.</p>
        </x-panel>

        {{-- File & dropzone --}}
        <x-panel id="files" title="File &amp; dropzone">
            <div>
                <label class="ap-label">Input berkas</label>
                <div class="flex items-center gap-1.5">
                    <label class="flex h-7 cursor-pointer items-center gap-1.5 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/></svg>
                        Pilih berkas
                        <input type="file" class="hidden" onchange="document.getElementById('apFileName').textContent = this.files.length ? this.files[0].name : 'Belum ada berkas'" data-testid="file-input">
                    </label>
                    <span class="truncate font-mono text-[10px] text-muted-foreground" id="apFileName" data-testid="file-name">Belum ada berkas</span>
                </div>
            </div>
            <div class="grid-canvas flex h-24 flex-col items-center justify-center rounded-md border border-dashed border-border transition-colors hover:border-accent/60" data-testid="dropzone">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"/></svg>
                <p class="mt-1.5 text-[11px] font-medium">Tarik berkas ke sini</p>
                <p class="mt-0.5 text-[10px] text-muted-foreground">PNG, JPG, atau PDF &middot; maks 10 MB</p>
            </div>
            <div class="divide-y divide-border rounded-md border border-border">
                @foreach ([['laporan-juni.pdf', '2,4 MB', 100], ['aset-brand.zip', '18,1 MB', 62]] as [$f, $size, $pct])
                    <div class="flex items-center gap-2 px-2.5 py-1.5">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="h-3.5 w-3.5 shrink-0 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-2">
                                <p class="truncate font-mono text-[10.5px]">{{ $f }}</p>
                                <span class="shrink-0 font-mono text-[9px] text-muted-foreground">{{ $size }}</span>
                            </div>
                            <div class="mt-1 h-[3px] w-full overflow-hidden rounded-full bg-muted">
                                <div class="h-full rounded-full {{ $pct === 100 ? 'bg-emerald-500' : 'bg-accent' }}" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                        <button type="button" class="flex h-4 w-4 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="h-2.5 w-2.5"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </x-panel>

        {{-- Date & time --}}
        <x-panel id="datetime" title="Date &amp; time">
            <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-3">
                <div>
                    <label class="ap-label" for="e-date">Tanggal</label>
                    <input id="e-date" type="date" value="2026-06-17" class="ap-input" data-testid="input-date">
                </div>
                <div>
                    <label class="ap-label" for="e-time">Waktu</label>
                    <input id="e-time" type="time" value="09:30" class="ap-input">
                </div>
                <div>
                    <label class="ap-label" for="e-month">Bulan</label>
                    <input id="e-month" type="month" value="2026-06" class="ap-input">
                </div>
                <div class="sm:col-span-2">
                    <label class="ap-label">Rentang tanggal</label>
                    <div class="flex items-center gap-1.5">
                        <input type="date" value="2026-06-01" class="ap-input">
                        <span class="text-muted-foreground">&rarr;</span>
                        <input type="date" value="2026-06-30" class="ap-input">
                    </div>
                </div>
                <div>
                    <label class="ap-label">Preset</label>
                    <select class="ap-input"><option>7 hari terakhir</option><option selected>30 hari terakhir</option><option>Kuartal ini</option></select>
                </div>
            </div>
        </x-panel>

        {{-- Color --}}
        <x-panel id="color" title="Color">
            <div class="flex flex-wrap items-end gap-2.5 sm:gap-3">
                <div>
                    <label class="ap-label" for="e-color">Pemilih warna</label>
                    <div class="flex items-center gap-1.5">
                        <input id="e-color" type="color" value="#2563EB" oninput="document.getElementById('apHex').value = this.value.toUpperCase()"
                               class="h-7 w-9 cursor-pointer rounded-md border border-border bg-background p-0.5" data-testid="input-color">
                        <input id="apHex" type="text" value="#2563EB" class="ap-input !w-24 font-mono !text-[10.5px]">
                    </div>
                </div>
                <div>
                    <label class="ap-label">Swatch</label>
                    <div class="flex flex-wrap gap-1">
                        @foreach (['#2563EB', '#059669', '#D97706', '#DC2626', '#7C3AED', '#0891B2', '#0A0A0A'] as $i => $hex)
                            <button type="button" onclick="document.getElementById('e-color').value='{{ $hex }}';document.getElementById('apHex').value='{{ $hex }}'"
                                    class="h-6 w-6 rounded-md border border-border transition-transform hover:scale-110 {{ $i === 0 ? 'ring-1 ring-accent ring-offset-1 ring-offset-surface' : '' }}"
                                    style="background: {{ $hex }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-panel>

        {{-- Tags input --}}
        <x-panel id="tags" title="Tags input">
            <div>
                <label class="ap-label">Label proyek</label>
                <div class="flex min-h-7 flex-wrap items-center gap-1 rounded-md border border-border bg-background p-1 focus-within:border-accent focus-within:ring-1 focus-within:ring-accent/40" id="apTagWrap" data-testid="tags-input">
                    <input type="text" placeholder="Tambah label lalu Enter" onkeydown="apTagKey(event, this)"
                           class="h-5 min-w-[120px] flex-1 bg-transparent px-1 text-[11.5px] placeholder:text-muted-foreground focus:outline-none" data-testid="tags-field">
                </div>
                <p class="ap-help mt-1">Enter untuk menambah, Backspace pada kolom kosong untuk menghapus.</p>
            </div>
        </x-panel>

        {{-- Autocomplete --}}
        <x-panel id="search" title="Autocomplete">
            <div>
                <label class="ap-label" for="e-ac">Cari pengguna</label>
                <div class="relative">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="ap-input-icon"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    <input id="e-ac" type="text" list="apUsers" placeholder="Ketik nama atau email" class="ap-input !pl-7" data-testid="autocomplete-input">
                    <datalist id="apUsers">
                        <option value="Admin Root"></option><option value="Bima Kurniawan"></option>
                        <option value="Citra Maharani"></option><option value="Dimas Prakoso"></option>
                    </datalist>
                </div>
            </div>
            <div class="overflow-hidden rounded-md border border-border">
                @foreach ([['Bima Kurniawan', 'bima@nexus.local'], ['Citra Maharani', 'citra@nexus.local']] as $s)
                    <button type="button" class="flex w-full items-center gap-2 px-2.5 py-1.5 text-left transition-colors hover:bg-muted">
                        <span class="flex h-5 w-5 items-center justify-center rounded bg-muted text-[8.5px] font-semibold text-muted-foreground">{{ Str::upper(Str::substr($s[0], 0, 2)) }}</span>
                        <span class="min-w-0 flex-1 truncate text-[11.5px] font-medium">{{ $s[0] }}</span>
                        <span class="shrink-0 font-mono text-[9.5px] text-muted-foreground">{{ $s[1] }}</span>
                    </button>
                @endforeach
            </div>
        </x-panel>

        {{-- Form layout --}}
        <x-panel id="layout" title="Form layout" class="xl:col-span-2">
            <div class="grid grid-cols-1 gap-x-4 gap-y-2.5 sm:grid-cols-2 xl:grid-cols-3">
                <div>
                    <label class="ap-label">Nama depan</label>
                    <input type="text" value="Admin" class="ap-input">
                </div>
                <div>
                    <label class="ap-label">Nama belakang</label>
                    <input type="text" value="Root" class="ap-input">
                </div>
                <div>
                    <label class="ap-label">Zona waktu</label>
                    <select class="ap-input"><option selected>Asia/Jakarta (GMT+7)</option><option>Asia/Makassar (GMT+8)</option></select>
                </div>
                <div class="sm:col-span-2 xl:col-span-3">
                    <p class="mb-1.5 mt-1 flex items-center gap-2 font-mono text-[9px] uppercase tracking-[0.14em] text-muted-foreground">
                        Preferensi <span class="h-px flex-1 bg-border"></span>
                    </p>
                </div>
                <label class="flex cursor-pointer items-center gap-2 text-[11.5px]">
                    <input type="checkbox" checked class="h-3.5 w-3.5 rounded border-border bg-background text-accent"> Kirim ringkasan mingguan
                </label>
                <label class="flex cursor-pointer items-center gap-2 text-[11.5px]">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-border bg-background text-accent"> Tampilkan tips onboarding
                </label>
                <label class="flex cursor-pointer items-center gap-2 text-[11.5px]">
                    <input type="checkbox" checked class="h-3.5 w-3.5 rounded border-border bg-background text-accent"> Aktifkan mode compact
                </label>
            </div>
            <x-slot:footer>
                <button type="reset" data-testid="reset-form" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium text-muted-foreground transition-colors hover:text-foreground">Reset</button>
                <button type="submit" data-testid="submit-form" class="h-7 rounded-md bg-primary px-2.5 text-[11.5px] font-medium text-primary-foreground transition-opacity hover:opacity-90">Simpan perubahan</button>
            </x-slot:footer>
        </x-panel>

    </div>
    </form>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/elements.js') }}"></script>
@endpush
