@extends('layouts.app')

@section('title', 'Interface')
@section('breadcrumb', 'Interface')

@php
    $sections = [
        'typography' => 'Typography', 'colors' => 'Colors', 'buttons' => 'Buttons',
        'badges' => 'Badges & Tags', 'avatars' => 'Avatars', 'alerts' => 'Alerts',
        'cards' => 'Cards', 'lists' => 'Lists', 'tabs' => 'Tabs', 'accordion' => 'Accordion',
        'segmented' => 'Segmented control', 'steps' => 'Steps', 'progress' => 'Progress',
        'rating' => 'Stars rating', 'dropdowns' => 'Dropdowns', 'modals' => 'Modals',
        'toasts' => 'Toasts', 'tables' => 'Tables', 'pagination' => 'Pagination',
        'placeholder' => 'Placeholder',
    ];
@endphp

@section('content')
<div class="p-3 sm:p-4" data-testid="interface-page">

    <div class="mb-3">
        <h1 class="ap-h1" data-testid="page-title">Interface</h1>
        <p class="ap-p mt-1.5">Katalog komponen antarmuka &mdash; semua padat, dua tema, tanpa dependensi eksternal.</p>
    </div>

    <div class="mb-3 flex flex-wrap gap-1" data-testid="section-index">
        @foreach ($sections as $id => $label)
            <a href="#{{ $id }}"
               class="rounded border border-border bg-surface px-1.5 py-[3px] font-mono text-[9.5px] uppercase tracking-[0.1em] text-muted-foreground transition-colors hover:border-accent/50 hover:text-foreground">{{ $label }}</a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 items-start gap-3 xl:grid-cols-2">

        {{-- Typography --}}
        <x-panel id="typography" title="Typography" hint="Geist &middot; skala compact">
            <h1 class="ap-h1">Heading 1 &mdash; 18px semibold</h1>
            <h2 class="ap-h2">Heading 2 &mdash; 16px semibold</h2>
            <h3 class="ap-h3">Heading 3 &mdash; 14px medium</h3>
            <p class="ap-p">
                Paragraf 13px. Ini ukuran teks isi konten. <a href="#typography" class="text-accent underline decoration-accent/40 underline-offset-2 hover:decoration-accent">tautan</a>,
                <strong class="font-semibold text-foreground">tebal</strong>, <em class="italic">miring</em>,
                <code class="rounded border border-border bg-muted px-1 py-px font-mono text-[11.5px]">inline code</code>,
                <s class="text-muted-foreground">dibatalkan</s>.
            </p>
            <blockquote class="ap-quote border-l-2 border-accent pl-2.5">
                Densitas adalah fitur, bukan kompromi.
            </blockquote>
            <p class="ap-mono-label">Label mono 10px &middot; tracking lebar</p>
        </x-panel>

        {{-- Colors --}}
        <x-panel id="colors" title="Colors" hint="CSS variables">
            <div class="grid grid-cols-4 gap-1.5 sm:grid-cols-7">
                @foreach ([['background','Background'],['surface','Surface'],['elevated','Elevated'],['muted','Muted'],['border','Border'],['foreground','Foreground'],['accent','Accent']] as [$var, $name])
                    <div>
                        <div class="h-9 rounded-md border border-border" style="background: var(--{{ $var }})"></div>
                        <p class="mt-1 truncate text-[9.5px] font-medium">{{ $name }}</p>
                        <p class="truncate font-mono text-[8.5px] text-muted-foreground">--{{ $var }}</p>
                    </div>
                @endforeach
            </div>
            <div class="grid grid-cols-4 gap-1.5">
                @foreach ([['emerald','Success'],['amber','Warning'],['red','Danger'],['sky','Info']] as [$c, $name])
                    <div>
                        <div class="h-6 rounded-md bg-{{ $c }}-500"></div>
                        <p class="mt-1 text-[9.5px] font-medium">{{ $name }}</p>
                    </div>
                @endforeach
            </div>
        </x-panel>

        {{-- Buttons --}}
        <x-panel id="buttons" title="Buttons" hint="h-7 &middot; radius 6px">
            <div class="flex flex-wrap items-center gap-1.5">
                <button class="h-7 rounded-md bg-primary px-2.5 text-[11.5px] font-medium text-primary-foreground transition-opacity hover:opacity-90 active:scale-[0.98]" data-testid="btn-primary">Primary</button>
                <button class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted active:scale-[0.98]">Secondary</button>
                <button class="h-7 rounded-md px-2.5 text-[11.5px] font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">Ghost</button>
                <button class="h-7 rounded-md bg-accent px-2.5 text-[11.5px] font-medium text-white transition-opacity hover:opacity-90">Accent</button>
                <button class="h-7 rounded-md bg-red-500 px-2.5 text-[11.5px] font-medium text-white transition-opacity hover:opacity-90">Danger</button>
                <button class="h-7 rounded-md border border-dashed border-border px-2.5 text-[11.5px] font-medium text-muted-foreground">Dashed</button>
                <button disabled class="h-7 cursor-not-allowed rounded-md bg-muted px-2.5 text-[11.5px] font-medium text-muted-foreground opacity-60">Disabled</button>
            </div>
            <div class="flex flex-wrap items-center gap-1.5">
                <button class="flex h-6 items-center gap-1 rounded px-2 text-[10.5px] font-medium ring-1 ring-inset ring-border transition-colors hover:bg-muted">XS</button>
                <button class="flex h-7 items-center gap-1.5 rounded-md border border-border px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Dengan ikon
                </button>
                <button class="flex h-7 w-7 items-center justify-center rounded-md border border-border transition-colors hover:bg-muted">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                </button>
                <button class="h-7 rounded-full bg-primary px-3 text-[11.5px] font-medium text-primary-foreground">Pill</button>
                <button class="flex h-7 items-center gap-1.5 rounded-md border border-border px-2.5 text-[11.5px] font-medium text-muted-foreground" disabled>
                    <svg viewBox="0 0 24 24" fill="none" class="h-3.5 w-3.5 animate-spin"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2.5" stroke-opacity=".2"/><path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
                    Memuat&hellip;
                </button>
            </div>
            <div class="inline-flex overflow-hidden rounded-md border border-border">
                <button class="h-7 border-r border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Kiri</button>
                <button class="h-7 border-r border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Tengah</button>
                <button class="h-7 bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Kanan</button>
            </div>
        </x-panel>

        {{-- Badges & Tags --}}
        <x-panel id="badges" title="Badges &amp; Tags">
            <div class="flex flex-wrap items-center gap-1.5">
                <span class="rounded bg-primary px-1.5 py-px text-[10px] font-medium text-primary-foreground">Default</span>
                <span class="rounded border border-border bg-muted px-1.5 py-px text-[10px] font-medium text-muted-foreground">Muted</span>
                <span class="rounded bg-emerald-500/15 px-1.5 py-px text-[10px] font-medium text-emerald-600 dark:text-emerald-400">Aktif</span>
                <span class="rounded bg-amber-500/15 px-1.5 py-px text-[10px] font-medium text-amber-600 dark:text-amber-400">Tertunda</span>
                <span class="rounded bg-red-500/15 px-1.5 py-px text-[10px] font-medium text-red-600 dark:text-red-400">Gagal</span>
                <span class="rounded bg-sky-500/15 px-1.5 py-px text-[10px] font-medium text-sky-600 dark:text-sky-400">Info</span>
                <span class="flex items-center gap-1 rounded border border-border px-1.5 py-px text-[10px] font-medium">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Online
                </span>
                <span class="flex h-4 min-w-4 items-center justify-center rounded-full bg-accent px-1 font-mono text-[9px] font-semibold text-white">12</span>
            </div>
            <div class="flex flex-wrap items-center gap-1.5">
                @foreach (['laravel', 'sqlite', 'tailwind', 'geist'] as $tag)
                    <span class="flex items-center gap-1 rounded-md border border-border bg-surface pl-1.5 pr-1 py-[2px] font-mono text-[9.5px] text-muted-foreground">
                        {{ $tag }}
                        <button class="flex h-3 w-3 items-center justify-center rounded-sm transition-colors hover:bg-muted hover:text-foreground">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2 w-2"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                    </span>
                @endforeach
            </div>
        </x-panel>

        {{-- Avatars --}}
        <x-panel id="avatars" title="Avatars">
            <div class="flex flex-wrap items-center gap-2">
                <span class="flex h-5 w-5 items-center justify-center rounded-md bg-primary text-[8.5px] font-semibold text-primary-foreground">XS</span>
                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-primary text-[9.5px] font-semibold text-primary-foreground">SM</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-[7px] bg-primary text-[10.5px] font-semibold text-primary-foreground">MD</span>
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary text-[12px] font-semibold text-primary-foreground">LG</span>
                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-accent/15 text-[10.5px] font-semibold text-accent">AR</span>
                <span class="relative flex h-7 w-7 items-center justify-center rounded-full border border-border bg-muted text-muted-foreground">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                    <span class="absolute -bottom-px -right-px h-2 w-2 rounded-full bg-emerald-500 ring-2 ring-surface"></span>
                </span>
                <div class="flex -space-x-1.5">
                    @foreach (['AR','BK','CM','+5'] as $i)
                        <span class="flex h-6 w-6 items-center justify-center rounded-full border border-surface bg-muted text-[9px] font-semibold text-muted-foreground ring-1 ring-border">{{ $i }}</span>
                    @endforeach
                </div>
            </div>
        </x-panel>

        {{-- Alerts --}}
        <x-panel id="alerts" title="Alerts">
            @foreach ([['emerald','Berhasil','Perubahan tersimpan ke basis data.'],['amber','Perhatian','Sesi akan berakhir dalam 5 menit.'],['red','Kesalahan','Gagal menghubungi layanan pembayaran.'],['sky','Informasi','Versi baru panel tersedia.']] as [$c, $t, $d])
                <div class="flex items-start gap-2 rounded-md border border-{{ $c }}-500/25 bg-{{ $c }}-500/10 px-2.5 py-2">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="mt-px h-3.5 w-3.5 shrink-0 text-{{ $c }}-600 dark:text-{{ $c }}-400"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                    <div class="min-w-0 flex-1">
                        <p class="text-[11.5px] font-medium text-{{ $c }}-700 dark:text-{{ $c }}-300">{{ $t }}</p>
                        <p class="mt-0.5 text-[11px] text-{{ $c }}-700/80 dark:text-{{ $c }}-300/70">{{ $d }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="flex h-4 w-4 shrink-0 items-center justify-center rounded text-{{ $c }}-600/70 transition-colors hover:bg-{{ $c }}-500/15 dark:text-{{ $c }}-400/70">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="h-2.5 w-2.5"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endforeach
        </x-panel>

        {{-- Cards --}}
        <x-panel id="cards" title="Cards">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                @foreach ([['Pendapatan','Rp 48,2 jt','+12,4%','emerald'],['Pengguna','1.284','+3,1%','emerald'],['Refund','Rp 1,1 jt','-0,8%','red']] as [$label, $val, $delta, $c])
                    <div class="rounded-md border border-border bg-surface p-2.5 transition-colors hover:border-accent/40">
                        <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-muted-foreground">{{ $label }}</p>
                        <p class="mt-1.5 text-[15px] font-semibold leading-none tracking-tight">{{ $val }}</p>
                        <p class="mt-1.5 text-[10px] font-medium text-{{ $c }}-600 dark:text-{{ $c }}-400">{{ $delta }} <span class="text-muted-foreground">vs bulan lalu</span></p>
                    </div>
                @endforeach
            </div>
            <div class="overflow-hidden rounded-md border border-border bg-surface">
                <div class="flex h-8 items-center justify-between border-b border-border px-2.5">
                    <p class="text-[11.5px] font-medium">Kartu dengan header</p>
                    <button class="flex h-5 w-5 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path stroke-linecap="round" d="M6.75 12h.008v.008H6.75V12Zm5.25 0h.008v.008H12V12Zm5.25 0h.008v.008h-.008V12Z"/></svg>
                    </button>
                </div>
                <div class="p-2.5 text-[11px] leading-relaxed text-muted-foreground">
                    Badan kartu dengan padding 10px. Footer di bawah memakai latar muted untuk memisahkan aksi.
                </div>
                <div class="flex items-center justify-between gap-1.5 border-t border-border bg-muted px-2.5 py-2">
                    <button class="h-6 rounded border border-border bg-surface px-2 text-[11px] font-medium text-muted-foreground transition-colors hover:text-foreground">Batal</button>
                    <button class="h-6 rounded bg-primary px-2 text-[11px] font-medium text-primary-foreground">Simpan</button>
                </div>
            </div>
        </x-panel>

        {{-- Lists --}}
        <x-panel id="lists" title="Lists">
            <div class="divide-y divide-border overflow-hidden rounded-md border border-border bg-surface">
                @foreach ([['Deploy produksi','2 menit lalu','emerald'],['Migrasi basis data','1 jam lalu','sky'],['Rotasi kunci API','kemarin','amber']] as [$t, $time, $c])
                    <div class="flex items-center gap-2.5 px-2.5 py-2 transition-colors hover:bg-muted">
                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-{{ $c }}-500"></span>
                        <p class="min-w-0 flex-1 truncate text-[11.5px] font-medium">{{ $t }}</p>
                        <span class="font-mono text-[9.5px] text-muted-foreground">{{ $time }}</span>
                    </div>
                @endforeach
            </div>
            <ul class="space-y-1">
                @foreach (['Item daftar bertanda', 'Padat dan mudah dipindai', 'Ikon 12px sejajar baseline'] as $li)
                    <li class="flex items-start gap-1.5 text-[11.5px] text-muted-foreground">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="mt-[3px] h-3 w-3 shrink-0 text-accent"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                        {{ $li }}
                    </li>
                @endforeach
            </ul>
        </x-panel>

        {{-- Tabs --}}
        <x-panel id="tabs" title="Tabs">
            <div>
                <div class="scroll-thin flex items-center gap-0.5 overflow-x-auto border-b border-border" data-testid="tabs-underline">
                    @foreach (['Ringkasan', 'Aktivitas', 'Berkas'] as $i => $tab)
                        <button onclick="apTab(this, 'tab-u', {{ $i }})"
                                data-testid="tab-{{ $i }}"
                                class="ap-tab-u -mb-px h-7 border-b-[1.5px] px-2 text-[11.5px] font-medium transition-colors {{ $i === 0 ? 'border-foreground text-foreground' : 'border-transparent text-muted-foreground hover:text-foreground' }}">{{ $tab }}</button>
                    @endforeach
                </div>
                @foreach (['Panel ringkasan: metrik utama dan status sistem.', 'Panel aktivitas: 24 kejadian terakhir.', 'Panel berkas: 8 lampiran, total 12,4 MB.'] as $i => $body)
                    <p class="ap-pane-u pt-2 text-[11px] text-muted-foreground {{ $i === 0 ? '' : 'hidden' }}" data-testid="tab-pane-{{ $i }}">{{ $body }}</p>
                @endforeach
            </div>
            <div class="inline-flex rounded-md border border-border bg-muted p-0.5">
                @foreach (['Harian', 'Mingguan', 'Bulanan'] as $i => $tab)
                    <button onclick="apTab(this, 'tab-p', {{ $i }})"
                            class="ap-tab-p h-6 rounded px-2 text-[11px] font-medium transition-colors {{ $i === 0 ? 'bg-surface text-foreground shadow-sm' : 'text-muted-foreground hover:text-foreground' }}">{{ $tab }}</button>
                @endforeach
            </div>
        </x-panel>

        {{-- Accordion --}}
        <x-panel id="accordion" title="Accordion">
            <div class="divide-y divide-border overflow-hidden rounded-md border border-border bg-surface" data-testid="accordion">
                @foreach ([['Bagaimana cara kerja tema?','Tema memakai class dark pada elemen html dan CSS variables, disimpan di localStorage.'],['Di mana data disimpan?','SQLite tunggal pada database/database.sqlite, diakses lewat Eloquent.'],['Apakah butuh build step?','Tidak. Tailwind dimuat dari CDN dan dikonfigurasi inline.']] as $i => [$q, $a])
                    <div>
                        <button onclick="apAccordion(this)" data-testid="accordion-trigger-{{ $i }}"
                                class="flex h-8 w-full items-center gap-2 px-2.5 text-left text-[11.5px] font-medium transition-colors hover:bg-muted">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3 shrink-0 text-muted-foreground transition-transform duration-200"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                            {{ $q }}
                        </button>
                        <div class="hidden px-2.5 pb-2.5 pl-[26px] text-[11px] leading-relaxed text-muted-foreground" data-testid="accordion-panel-{{ $i }}">{{ $a }}</div>
                    </div>
                @endforeach
            </div>
        </x-panel>

        {{-- Segmented control --}}
        <x-panel id="segmented" title="Segmented control">
            <div class="inline-flex max-w-full flex-wrap rounded-md border border-border bg-muted p-0.5" data-testid="segmented">
                @foreach ([['Kode','M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5'],['Pratinjau','M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z'],['Terpisah','M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5']] as $i => [$label, $path])
                    <button onclick="apTab(this, 'seg', {{ $i }})"
                            class="ap-seg flex h-6 items-center gap-1.5 rounded px-2 text-[11px] font-medium transition-colors {{ $i === 1 ? 'bg-surface text-foreground shadow-sm' : 'text-muted-foreground hover:text-foreground' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3 w-3"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/></svg>
                        {{ $label }}
                    </button>
                @endforeach
            </div>
            <div class="inline-flex overflow-hidden rounded-md border border-border">
                @foreach (['S', 'M', 'L', 'XL'] as $i => $size)
                    <button onclick="apTab(this, 'seg2', {{ $i }})"
                            class="ap-seg2 h-6 w-7 border-r border-border text-[10.5px] font-medium transition-colors last:border-r-0 {{ $i === 1 ? 'bg-primary text-primary-foreground' : 'bg-surface text-muted-foreground hover:bg-muted hover:text-foreground' }}">{{ $size }}</button>
                @endforeach
            </div>
        </x-panel>

        {{-- Steps --}}
        <x-panel id="steps" title="Steps">
            <div class="scroll-thin -mx-0.5 flex items-center overflow-x-auto px-0.5 pb-1" data-testid="steps">
                @foreach ([['Akun', true], ['Verifikasi', true], ['Paket', false], ['Selesai', false]] as $i => [$label, $done])
                    <div class="flex items-center {{ $i < 3 ? 'flex-1' : '' }}">
                        <div class="flex items-center gap-1.5">
                            <span class="flex h-5 w-5 items-center justify-center rounded-full text-[9.5px] font-semibold {{ $done ? 'bg-primary text-primary-foreground' : ($i === 2 ? 'border-[1.5px] border-accent text-accent' : 'border border-border text-muted-foreground') }}">
                                @if ($done)
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="h-2.5 w-2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </span>
                            <span class="hidden text-[11px] font-medium sm:block {{ $done || $i === 2 ? 'text-foreground' : 'text-muted-foreground' }}">{{ $label }}</span>
                        </div>
                        @if ($i < 3)
                            <span class="mx-2 h-px flex-1 {{ $done ? 'bg-primary' : 'bg-border' }}"></span>
                        @endif
                    </div>
                @endforeach
            </div>
            <ol class="space-y-0">
                @foreach ([['Kloning repositori', 'selesai'], ['Jalankan migrasi', 'berjalan'], ['Deploy', 'menunggu']] as $i => [$t, $st])
                    <li class="relative flex gap-2.5 pb-2.5 last:pb-0">
                        <span class="absolute left-[3px] top-2 h-full w-px bg-border last:hidden {{ $i === 2 ? 'hidden' : '' }}"></span>
                        <span class="relative mt-[5px] h-[7px] w-[7px] shrink-0 rounded-full {{ $i === 0 ? 'bg-primary' : ($i === 1 ? 'bg-accent' : 'bg-border') }}"></span>
                        <div class="min-w-0">
                            <p class="text-[11.5px] font-medium leading-tight">{{ $t }}</p>
                            <p class="mt-0.5 font-mono text-[9px] uppercase tracking-[0.12em] text-muted-foreground">{{ $st }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </x-panel>

        {{-- Progress --}}
        <x-panel id="progress" title="Progress">
            @foreach ([['Penyimpanan', 72, 'accent'], ['CPU', 34, 'emerald'], ['Memori', 91, 'red']] as [$label, $val, $c])
                <div>
                    <div class="mb-1 flex items-center justify-between">
                        <span class="text-[11px] font-medium">{{ $label }}</span>
                        <span class="font-mono text-[9.5px] text-muted-foreground">{{ $val }}%</span>
                    </div>
                    <div class="h-1 w-full overflow-hidden rounded-full bg-muted">
                        <div class="h-full rounded-full {{ $c === 'accent' ? 'bg-accent' : 'bg-'.$c.'-500' }}" style="width: {{ $val }}%"></div>
                    </div>
                </div>
            @endforeach
            <div class="flex h-1 w-full overflow-hidden rounded-full bg-muted">
                <span class="h-full bg-accent" style="width:45%"></span>
                <span class="h-full bg-emerald-500" style="width:25%"></span>
                <span class="h-full bg-amber-500" style="width:15%"></span>
            </div>
            <div class="flex items-center gap-3">
                <svg viewBox="0 0 36 36" class="h-9 w-9 -rotate-90">
                    <circle cx="18" cy="18" r="15" fill="none" stroke="var(--muted)" stroke-width="3"/>
                    <circle cx="18" cy="18" r="15" fill="none" stroke="var(--accent)" stroke-width="3" stroke-linecap="round" stroke-dasharray="94.2" stroke-dashoffset="28"/>
                </svg>
                <div>
                    <p class="text-[11.5px] font-medium leading-none">70% terpakai</p>
                    <p class="mt-1 font-mono text-[9.5px] text-muted-foreground">7,0 / 10,0 GB</p>
                </div>
            </div>
        </x-panel>

        {{-- Stars rating --}}
        <x-panel id="rating" title="Stars rating">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-0.5" id="apStars" data-testid="stars-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <button onclick="apRate({{ $i }})" data-testid="star-{{ $i }}" class="ap-star transition-transform hover:scale-110">
                            <svg viewBox="0 0 24 24" fill="{{ $i <= 3 ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" class="h-3.5 w-3.5 {{ $i <= 3 ? 'text-amber-500' : 'text-muted-foreground' }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                            </svg>
                        </button>
                    @endfor
                </div>
                <span class="font-mono text-[9.5px] text-muted-foreground" id="apRateLabel" data-testid="rating-value">3,0 / 5</span>
            </div>
            <div class="space-y-1">
                @foreach ([[5, 62], [4, 24], [3, 9], [2, 3], [1, 2]] as [$star, $pct])
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 font-mono text-[9.5px] text-muted-foreground">{{ $star }}</span>
                        <svg viewBox="0 0 24 24" fill="currentColor" class="h-2.5 w-2.5 text-amber-500"><path d="M11.48 3.5a.56.56 0 0 1 1.04 0l2.13 5.11 5.51.45c.5.04.7.66.32.99l-4.2 3.6 1.29 5.38a.56.56 0 0 1-.84.61L12 16.75l-4.73 2.89a.56.56 0 0 1-.84-.61l1.29-5.38-4.2-3.6a.56.56 0 0 1 .32-.99l5.51-.45L11.48 3.5Z"/></svg>
                        <div class="h-1 flex-1 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-amber-500" style="width: {{ $pct }}%"></div></div>
                        <span class="w-6 text-right font-mono text-[9px] text-muted-foreground">{{ $pct }}%</span>
                    </div>
                @endforeach
            </div>
        </x-panel>

        {{-- Dropdowns --}}
        <x-panel id="dropdowns" title="Dropdowns">
            <div class="flex flex-wrap gap-1.5">
                <div class="relative">
                    <button onclick="apDrop(event, 'dd1')" data-testid="dropdown-trigger"
                            class="flex h-7 items-center gap-1.5 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">
                        Tindakan
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </button>
                    <div id="dd1" class="ap-drop absolute left-0 top-8 z-40 hidden w-40 rounded-lg border border-border bg-elevated p-1 shadow-xl shadow-black/5" data-testid="dropdown-menu">
                        @foreach ([['Duplikat','M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75'],['Arsipkan','m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25 2.25-2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z'],['Bagikan','M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z']] as [$label, $path])
                            <button class="flex h-7 w-full items-center gap-2 rounded px-2 text-[11.5px] text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/></svg>
                                {{ $label }}
                            </button>
                        @endforeach
                        <div class="my-1 h-px bg-border"></div>
                        <button class="flex h-7 w-full items-center gap-2 rounded px-2 text-[11.5px] text-red-600 transition-colors hover:bg-red-500/10 dark:text-red-400">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                            Hapus
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <button onclick="apDrop(event, 'dd2')" class="flex h-7 w-7 items-center justify-center rounded-md border border-border bg-surface text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path stroke-linecap="round" d="M12 6.75h.008v.008H12V6.75Zm0 5.25h.008v.008H12V12Zm0 5.25h.008v.008H12v-.008Z"/></svg>
                    </button>
                    <div id="dd2" class="ap-drop absolute left-0 top-8 z-40 hidden w-36 rounded-lg border border-border bg-elevated p-1 shadow-xl shadow-black/5">
                        <p class="px-2 py-1 font-mono text-[9px] uppercase tracking-[0.12em] text-muted-foreground">Urutkan</p>
                        @foreach (['Terbaru', 'Terlama', 'Nama A-Z'] as $i => $opt)
                            <button class="flex h-7 w-full items-center justify-between rounded px-2 text-[11.5px] {{ $i === 0 ? 'bg-muted text-foreground' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }}">
                                {{ $opt }}
                                @if ($i === 0)
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" class="h-3 w-3 text-accent"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="group relative">
                    <button class="h-7 rounded-md border border-dashed border-border px-2.5 text-[11.5px] font-medium text-muted-foreground">Hover tooltip</button>
                    <span class="pointer-events-none absolute -top-6 left-1/2 hidden -translate-x-1/2 whitespace-nowrap rounded bg-foreground px-1.5 py-0.5 text-[10px] font-medium text-background group-hover:block">Tooltip padat</span>
                </div>
            </div>
        </x-panel>

        {{-- Modals --}}
        <x-panel id="modals" title="Modals" hint="sm 300 &middot; md 340 &middot; lg 560">
            <div>
                <p class="ap-mod-label">Ukuran</p>
                <div class="flex flex-wrap gap-1.5">
                    <button onclick="apDemoModal('sm', 'center')" data-testid="modal-sm" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Small</button>
                    <button onclick="apDemoModal('md', 'center')" data-testid="modal-md" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Medium (default)</button>
                    <button onclick="apDemoModal('lg', 'center')" data-testid="modal-lg" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Large</button>
                </div>
            </div>
            <div>
                <p class="ap-mod-label">Posisi</p>
                <div class="flex flex-wrap gap-1.5">
                    <button onclick="apDemoModal('md', 'center')" data-testid="modal-center" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Tengah</button>
                    <button onclick="apDemoModal('md', 'top')" data-testid="modal-top" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Atas</button>
                </div>
            </div>
            <div>
                <p class="ap-mod-label">Contoh siap pakai</p>
                <div class="flex flex-wrap gap-1.5">
                    <button onclick="apModal('apModal1', true)" data-testid="open-modal" class="h-7 rounded-md bg-primary px-2.5 text-[11.5px] font-medium text-primary-foreground transition-opacity hover:opacity-90">Form modal</button>
                    <button onclick="apModal('apModal2', true)" data-testid="open-confirm" class="h-7 rounded-md border border-red-500/40 px-2.5 text-[11.5px] font-medium text-red-600 transition-colors hover:bg-red-500/10 dark:text-red-400">Konfirmasi hapus</button>
                </div>
            </div>
        </x-panel>

        {{-- Toasts --}}
        <x-panel id="toasts" title="Toasts">
            <div class="flex flex-wrap gap-1.5">
                <button onclick="apToast('Perubahan tersimpan.', 'emerald')" data-testid="toast-success" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Sukses</button>
                <button onclick="apToast('Koneksi tidak stabil.', 'amber')" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Peringatan</button>
                <button onclick="apToast('Gagal menyimpan data.', 'red')" class="h-7 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">Error</button>
            </div>
            <p class="text-[11px] text-muted-foreground">Toast muncul di kanan bawah, hilang otomatis setelah 3 detik.</p>
        </x-panel>

        {{-- Tables --}}
        <x-panel id="tables" title="Tables" class="xl:col-span-2">
            <div class="overflow-hidden rounded-md border border-border">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left" data-testid="data-table">
                        <thead class="bg-muted">
                            <tr>
                                <th class="w-8 px-2.5 py-1.5"><input type="checkbox" class="h-3 w-3 rounded border-border bg-background text-accent"></th>
                                @foreach (['ID', 'Nama', 'Email', 'Peran', 'Status', 'Dibuat'] as $th)
                                    <th class="whitespace-nowrap px-2.5 py-1.5 font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground">{{ $th }}</th>
                                @endforeach
                                <th class="w-8 px-2.5 py-1.5"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border bg-surface">
                            @foreach ([[1,'Admin Root','admin@nexus.local','Owner','Aktif','emerald'],[2,'Bima Kurniawan','bima@nexus.local','Editor','Aktif','emerald'],[3,'Citra Maharani','citra@nexus.local','Viewer','Tertunda','amber'],[4,'Dimas Prakoso','dimas@nexus.local','Editor','Nonaktif','red']] as [$id, $name, $mail, $role, $status, $c])
                                <tr class="transition-colors hover:bg-muted">
                                    <td class="px-2.5 py-1.5"><input type="checkbox" class="h-3 w-3 rounded border-border bg-background text-accent"></td>
                                    <td class="px-2.5 py-1.5 font-mono text-[10px] text-muted-foreground">#{{ str_pad($id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5">
                                        <div class="flex items-center gap-1.5">
                                            <span class="flex h-5 w-5 items-center justify-center rounded bg-muted text-[8.5px] font-semibold text-muted-foreground">{{ Str::upper(Str::substr($name, 0, 2)) }}</span>
                                            <span class="text-[11.5px] font-medium">{{ $name }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5 font-mono text-[10px] text-muted-foreground">{{ $mail }}</td>
                                    <td class="px-2.5 py-1.5 text-[11px] text-muted-foreground">{{ $role }}</td>
                                    <td class="px-2.5 py-1.5"><span class="rounded bg-{{ $c }}-500/15 px-1.5 py-px text-[10px] font-medium text-{{ $c }}-600 dark:text-{{ $c }}-400">{{ $status }}</span></td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5 font-mono text-[10px] text-muted-foreground">2026-06-0{{ $id }}</td>
                                    <td class="px-2.5 py-1.5">
                                        <button class="flex h-5 w-5 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-border hover:text-foreground">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path stroke-linecap="round" d="M6.75 12h.008v.008H6.75V12Zm5.25 0h.008v.008H12V12Zm5.25 0h.008v.008h-.008V12Z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-2 border-t border-border bg-muted px-2.5 py-1.5">
                    <span class="font-mono text-[9.5px] uppercase tracking-[0.1em] text-muted-foreground">4 dari 128 baris</span>
                    <div class="flex items-center gap-1">
                        <button class="flex h-6 w-6 items-center justify-center rounded border border-border bg-surface text-muted-foreground transition-colors hover:text-foreground">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/></svg>
                        </button>
                        <button class="flex h-6 w-6 items-center justify-center rounded border border-border bg-surface text-muted-foreground transition-colors hover:text-foreground">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </x-panel>

        {{-- Pagination --}}
        <x-panel id="pagination" title="Pagination">
            <div class="flex items-center gap-1" data-testid="pagination">
                <button class="flex h-6 items-center gap-1 rounded border border-border bg-surface px-1.5 text-[10.5px] font-medium text-muted-foreground transition-colors hover:text-foreground">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-2.5 w-2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/></svg>
                    Sebelumnya
                </button>
                @foreach ([1, 2, 3] as $p)
                    <button class="h-6 w-6 rounded border text-[10.5px] font-medium transition-colors {{ $p === 2 ? 'border-transparent bg-primary text-primary-foreground' : 'border-border bg-surface text-muted-foreground hover:text-foreground' }}">{{ $p }}</button>
                @endforeach
                <span class="px-0.5 text-[10.5px] text-muted-foreground">&hellip;</span>
                <button class="h-6 w-6 rounded border border-border bg-surface text-[10.5px] font-medium text-muted-foreground transition-colors hover:text-foreground">9</button>
                <button class="flex h-6 items-center gap-1 rounded border border-border bg-surface px-1.5 text-[10.5px] font-medium text-muted-foreground transition-colors hover:text-foreground">
                    Berikutnya
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-2.5 w-2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                </button>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="text-[11px] text-muted-foreground">Baris per halaman</span>
                <select class="h-6 rounded border border-border bg-background px-1.5 text-[11px] focus:border-accent focus:outline-none">
                    <option>10</option><option selected>25</option><option>50</option>
                </select>
            </div>
        </x-panel>

        {{-- Placeholder --}}
        <x-panel id="placeholder" title="Placeholder">
            <div class="space-y-2 rounded-md border border-border bg-surface p-2.5">
                <div class="flex items-center gap-2">
                    <div class="h-7 w-7 shrink-0 animate-pulse rounded-md bg-muted"></div>
                    <div class="flex-1 space-y-1.5">
                        <div class="h-2 w-1/3 animate-pulse rounded bg-muted"></div>
                        <div class="h-2 w-1/5 animate-pulse rounded bg-muted"></div>
                    </div>
                </div>
                <div class="h-2 w-full animate-pulse rounded bg-muted"></div>
                <div class="h-2 w-11/12 animate-pulse rounded bg-muted"></div>
                <div class="h-2 w-2/3 animate-pulse rounded bg-muted"></div>
            </div>
            <div class="grid-canvas flex h-20 flex-col items-center justify-center rounded-md border border-dashed border-border">
                <p class="text-[11px] font-medium">Area kosong</p>
                <p class="mt-0.5 text-[10.5px] text-muted-foreground">Tempatkan konten di sini</p>
            </div>
        </x-panel>

    </div>
</div>

{{-- Modal: standar --}}
<div id="apModal1" data-ap-modal class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-black/50 p-3 backdrop-blur-[2px] sm:p-4" data-testid="modal-standard">
    <div class="w-full max-w-[340px] overflow-hidden rounded-lg border border-border bg-elevated shadow-2xl">
        <div class="flex h-9 items-center justify-between border-b border-border px-3">
            <p class="text-[12px] font-semibold tracking-tight">Ubah profil</p>
            <button onclick="apModal('apModal1', false)" data-testid="modal-close" class="flex h-5 w-5 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="h-3 w-3"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="space-y-2.5 p-3">
            <div>
                <label class="mb-1 block text-[10px] font-medium uppercase tracking-[0.12em] text-muted-foreground">Nama</label>
                <input type="text" value="Admin Root" class="h-7 w-full rounded-md border border-border bg-background px-2 text-[11.5px] focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40">
            </div>
            <div>
                <label class="mb-1 block text-[10px] font-medium uppercase tracking-[0.12em] text-muted-foreground">Bio</label>
                <textarea rows="2" class="w-full rounded-md border border-border bg-background px-2 py-1.5 text-[11.5px] focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40">Mengelola panel Nexus.</textarea>
            </div>
        </div>
        <div class="flex items-center justify-between gap-1.5 border-t border-border bg-muted px-3 py-2">
            <button onclick="apModal('apModal1', false)" data-testid="modal-cancel" class="h-6 rounded border border-border bg-surface px-2 text-[11px] font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">Batal</button>
            <button onclick="apModal('apModal1', false); apToast('Profil diperbarui.', 'emerald')" class="h-6 rounded bg-primary px-2 text-[11px] font-medium text-primary-foreground">Simpan</button>
        </div>
    </div>
</div>

{{-- Modal: konfirmasi --}}
<div id="apModal2" data-ap-modal class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-black/50 p-3 backdrop-blur-[2px] sm:p-4" data-testid="modal-confirm">
    <div class="w-full max-w-[340px] overflow-hidden rounded-lg border border-border bg-elevated shadow-2xl">
        <div class="flex h-9 items-center justify-between border-b border-border px-3">
            <p class="text-[12px] font-semibold tracking-tight">Hapus 4 baris?</p>
            <button onclick="apModal('apModal2', false)" data-testid="confirm-close" class="flex h-5 w-5 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="h-3 w-3"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex items-start gap-2.5 p-3">
            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-red-500/15 text-red-600 dark:text-red-400">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
            </span>
            <div class="min-w-0">
                <p class="text-[11.5px] font-medium leading-tight">Tindakan ini permanen</p>
                <p class="mt-1 text-[11px] leading-relaxed text-muted-foreground">Empat baris terpilih akan dihapus dan tidak dapat dipulihkan.</p>
            </div>
        </div>
        <div class="flex items-center justify-between gap-1.5 border-t border-border bg-muted px-3 py-2">
            <button onclick="apModal('apModal2', false)" data-testid="confirm-cancel" class="h-6 rounded border border-border bg-surface px-2 text-[11px] font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">Batal</button>
            <button onclick="apModal('apModal2', false); apToast('4 baris dihapus.', 'red')" data-testid="confirm-delete" class="h-6 rounded bg-red-500 px-2 text-[11px] font-medium text-white transition-opacity hover:opacity-90">Hapus</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/interface.js') }}"></script>
@endpush
