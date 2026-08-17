@extends('layouts.app')

@section('title', 'Datatable')
@section('breadcrumb', 'Datatable')

@php
    $users = [
        ['NX-1041', 'Admin Root', 'admin@nexus.local', 'Owner', 'Aktif', '2026-06-01', 'emerald'],
        ['NX-1042', 'Bima Kurniawan', 'bima@nexus.local', 'Editor', 'Aktif', '2026-06-03', 'emerald'],
        ['NX-1043', 'Citra Maharani', 'citra@nexus.local', 'Viewer', 'Tertunda', '2026-06-05', 'amber'],
        ['NX-1044', 'Dimas Prakoso', 'dimas@nexus.local', 'Editor', 'Nonaktif', '2026-06-07', 'red'],
        ['NX-1045', 'Eka Wulandari', 'eka@nexus.local', 'Viewer', 'Aktif', '2026-06-09', 'emerald'],
        ['NX-1046', 'Fajar Nugroho', 'fajar@nexus.local', 'Admin', 'Aktif', '2026-06-11', 'emerald'],
        ['NX-1047', 'Gita Rahmawati', 'gita@nexus.local', 'Viewer', 'Tertunda', '2026-06-12', 'amber'],
        ['NX-1048', 'Hendra Saputra', 'hendra@nexus.local', 'Editor', 'Aktif', '2026-06-14', 'emerald'],
        ['NX-1049', 'Indah Permata', 'indah@nexus.local', 'Viewer', 'Nonaktif', '2026-06-15', 'red'],
        ['NX-1050', 'Joko Santoso', 'joko@nexus.local', 'Admin', 'Aktif', '2026-06-16', 'emerald'],
        ['NX-1051', 'Kirana Dewi', 'kirana@nexus.local', 'Editor', 'Aktif', '2026-06-17', 'emerald'],
        ['NX-1052', 'Luthfi Hakim', 'luthfi@nexus.local', 'Viewer', 'Tertunda', '2026-06-17', 'amber'],
    ];

    $orders = [
        ['INV-24081', 'Bima Kurniawan', 'Pro Tahunan', 1788000, 'Lunas', 'emerald', 'Transfer'],
        ['INV-24082', 'Citra Maharani', 'Starter Bulanan', 0, 'Gratis', 'sky', 'Kartu'],
        ['INV-24083', 'Dimas Prakoso', 'Skala Tahunan', 5988000, 'Menunggu', 'amber', 'Virtual Account'],
        ['INV-24084', 'Eka Wulandari', 'Pro Bulanan', 149000, 'Lunas', 'emerald', 'Kartu'],
        ['INV-24085', 'Fajar Nugroho', 'Pro Bulanan', 149000, 'Gagal', 'red', 'Kartu'],
        ['INV-24086', 'Gita Rahmawati', 'Skala Bulanan', 499000, 'Lunas', 'emerald', 'Transfer'],
        ['INV-24087', 'Hendra Saputra', 'Pro Tahunan', 1788000, 'Menunggu', 'amber', 'Virtual Account'],
    ];

    $traffic = [
        ['/dashboard', 18420, 62, 1.9, 'emerald'],
        ['/elements', 9310, 41, 2.4, 'sky'],
        ['/interface', 7885, 38, 2.1, 'sky'],
        ['/login', 5140, 74, 0.8, 'amber'],
        ['/datatable', 3120, 29, 3.2, 'emerald'],
    ];
@endphp

@section('content')
<div class="p-3 sm:p-4" data-testid="datatable-page">

    <div class="mb-3">
        <h1 class="ap-h1" data-testid="page-title">Datatable</h1>
        <p class="ap-p mt-1.5">Tiga contoh tabel data: dasar dengan pencarian &amp; sortir, lanjutan dengan filter &amp; kolom, serta ringkasan dengan total.</p>
    </div>

    <div class="space-y-3">

        {{-- 1. Basic datatable --}}
        <x-panel id="dt-basic" title="Datatable dasar" hint="pencarian &middot; sortir &middot; paginasi">
            <div class="flex flex-wrap items-center gap-1.5">
                <div class="relative w-full sm:w-auto">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="pointer-events-none absolute left-2 top-1/2 h-3.5 w-3.5 -translate-y-1/2 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    <input type="text" placeholder="Cari nama, email, peran&hellip;" oninput="apDt.search('dt1', this.value)"
                           class="h-7 w-full rounded-md border border-border bg-background pl-7 pr-2 sm:w-56 text-[11.5px] placeholder:text-muted-foreground focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40"
                           data-testid="dt1-search">
                </div>
                <select onchange="apDt.perPage('dt1', this.value)" class="h-7 rounded-md border border-border bg-background px-1.5 text-[11px] focus:border-accent focus:outline-none" data-testid="dt1-perpage">
                    <option value="5" selected>5 / halaman</option>
                    <option value="10">10 / halaman</option>
                    <option value="25">25 / halaman</option>
                </select>
                <div class="flex items-center gap-1.5 sm:ml-auto">
                    <span class="hidden font-mono text-[9px] uppercase tracking-[0.12em] text-muted-foreground sm:block" data-testid="dt1-selected">0 dipilih</span>
                    <button type="button" onclick="apToast('Ekspor CSV dimulai.', 'emerald')" class="flex h-7 items-center gap-1.5 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Ekspor
                    </button>
                </div>
            </div>

            <div class="overflow-hidden rounded-md border border-border">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left" id="dt1" data-testid="dt1-table">
                        <thead class="bg-muted">
                            <tr>
                                <th class="w-8 px-2.5 py-1.5"><input type="checkbox" onchange="apDt.selectAll('dt1', this.checked)" class="h-3 w-3 rounded border-border bg-background text-accent" data-testid="dt1-select-all"></th>
                                @foreach ([['ID', 0], ['Nama', 1], ['Email', 2], ['Peran', 3], ['Status', 4], ['Dibuat', 5]] as [$label, $col])
                                    <th class="whitespace-nowrap px-2.5 py-1.5">
                                        <button type="button" onclick="apDt.sort('dt1', {{ $col }}, this)" data-testid="dt1-sort-{{ $col }}"
                                                class="ap-dt-sort group flex items-center gap-1 font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground transition-colors hover:text-foreground">
                                            {{ $label }}
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="ap-dt-arrow h-2.5 w-2.5 opacity-0 transition-all group-hover:opacity-60"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                                        </button>
                                    </th>
                                @endforeach
                                <th class="w-8 px-2.5 py-1.5"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border bg-surface">
                            @foreach ($users as $u)
                                <tr class="ap-dt-row transition-colors hover:bg-muted">
                                    <td class="px-2.5 py-1.5"><input type="checkbox" onchange="apDt.count('dt1')" class="ap-dt-check h-3 w-3 rounded border-border bg-background text-accent"></td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5 font-mono text-[10px] text-muted-foreground">{{ $u[0] }}</td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5">
                                        <div class="flex items-center gap-1.5">
                                            <span class="flex h-5 w-5 items-center justify-center rounded bg-muted text-[8.5px] font-semibold text-muted-foreground">{{ Str::upper(Str::substr($u[1], 0, 2)) }}</span>
                                            <span class="text-[11.5px] font-medium">{{ $u[1] }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5 font-mono text-[10px] text-muted-foreground">{{ $u[2] }}</td>
                                    <td class="px-2.5 py-1.5 text-[11px] text-muted-foreground">{{ $u[3] }}</td>
                                    <td class="px-2.5 py-1.5"><span class="rounded bg-{{ $u[6] }}-500/15 px-1.5 py-px text-[10px] font-medium text-{{ $u[6] }}-600 dark:text-{{ $u[6] }}-400">{{ $u[4] }}</span></td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5 font-mono text-[10px] text-muted-foreground">{{ $u[5] }}</td>
                                    <td class="px-2.5 py-1.5">
                                        <button type="button" class="flex h-5 w-5 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-border hover:text-foreground">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path stroke-linecap="round" d="M6.75 12h.008v.008H6.75V12Zm5.25 0h.008v.008H12V12Zm5.25 0h.008v.008h-.008V12Z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="ap-dt-empty hidden">
                                <td colspan="8" class="px-2.5 py-6 text-center text-[11px] text-muted-foreground" data-testid="dt1-empty">Tidak ada data yang cocok.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-2 border-t border-border bg-muted px-2.5 py-1.5">
                    <span class="font-mono text-[9.5px] uppercase tracking-[0.1em] text-muted-foreground" data-testid="dt1-info">&nbsp;</span>
                    <div class="flex items-center gap-1" data-testid="dt1-pager"></div>
                </div>
            </div>
        </x-panel>

        {{-- 2. Advanced datatable --}}
        <x-panel id="dt-advanced" title="Datatable lanjutan" hint="filter status &middot; kolom &middot; header sticky">
            <div class="flex flex-wrap items-center gap-1.5">
                <div class="inline-flex max-w-full flex-wrap rounded-md border border-border bg-muted p-0.5" data-testid="dt2-filters">
                    @foreach (['Semua', 'Lunas', 'Menunggu', 'Gagal'] as $i => $f)
                        <button type="button" onclick="apDt.filter('dt2', '{{ $f === 'Semua' ? '' : $f }}', this)"
                                class="ap-dt-filter h-6 rounded px-2 text-[11px] font-medium transition-colors {{ $i === 0 ? 'bg-surface text-foreground shadow-sm' : 'text-muted-foreground hover:text-foreground' }}"
                                data-testid="dt2-filter-{{ Str::slug($f) }}">{{ $f }}</button>
                    @endforeach
                </div>

                <div class="relative w-full sm:w-auto">
                    <input type="text" placeholder="Cari invoice&hellip;" oninput="apDt.search('dt2', this.value)"
                           class="h-7 w-full rounded-md border border-border bg-background px-2 sm:w-44 text-[11.5px] placeholder:text-muted-foreground focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40"
                           data-testid="dt2-search">
                </div>

                <div class="relative sm:ml-auto">
                    <button type="button" onclick="apDrop(event, 'dt2cols')" data-testid="dt2-columns-trigger"
                            class="flex h-7 items-center gap-1.5 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium transition-colors hover:bg-muted">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                        Kolom
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3 text-muted-foreground"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </button>
                    <div id="dt2cols" class="ap-drop absolute right-0 top-8 z-40 hidden w-40 rounded-lg border border-border bg-elevated p-1 shadow-xl shadow-black/10" data-testid="dt2-columns-menu">
                        @foreach ([['Pelanggan', 2], ['Paket', 3], ['Metode', 4], ['Nilai', 5], ['Status', 6]] as [$label, $col])
                            <label class="flex h-7 cursor-pointer items-center gap-2 rounded px-2 text-[11.5px] text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                                <input type="checkbox" checked onchange="apDt.column('dt2', {{ $col }}, this.checked)" class="h-3 w-3 rounded border-border bg-background text-accent" data-testid="dt2-col-{{ $col }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-md border border-border">
                <div class="scroll-thin max-h-56 overflow-auto">
                    <table class="w-full border-collapse text-left" id="dt2" data-testid="dt2-table">
                        <thead class="sticky top-0 z-10 bg-muted">
                            <tr>
                                <th class="w-8 px-2.5 py-1.5"><input type="checkbox" onchange="apDt.selectAll('dt2', this.checked)" class="h-3 w-3 rounded border-border bg-background text-accent"></th>
                                @foreach ([['Invoice', 1], ['Pelanggan', 2], ['Paket', 3], ['Metode', 4]] as [$label, $col])
                                    <th class="ap-dt-col-{{ $col }} whitespace-nowrap px-2.5 py-1.5">
                                        <button type="button" onclick="apDt.sort('dt2', {{ $col }}, this)" class="ap-dt-sort group flex items-center gap-1 font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground transition-colors hover:text-foreground">
                                            {{ $label }}
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="ap-dt-arrow h-2.5 w-2.5 opacity-0 transition-all group-hover:opacity-60"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                                        </button>
                                    </th>
                                @endforeach
                                <th class="ap-dt-col-5 whitespace-nowrap px-2.5 py-1.5 text-right">
                                    <button type="button" onclick="apDt.sort('dt2', 5, this, 'num')" class="ap-dt-sort group ml-auto flex items-center gap-1 font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground transition-colors hover:text-foreground">
                                        Nilai
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="ap-dt-arrow h-2.5 w-2.5 opacity-0 transition-all group-hover:opacity-60"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                                    </button>
                                </th>
                                <th class="ap-dt-col-6 whitespace-nowrap px-2.5 py-1.5 font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border bg-surface">
                            @foreach ($orders as $o)
                                <tr class="ap-dt-row transition-colors hover:bg-muted" data-status="{{ $o[4] }}">
                                    <td class="px-2.5 py-1.5"><input type="checkbox" onchange="apDt.count('dt2')" class="ap-dt-check h-3 w-3 rounded border-border bg-background text-accent"></td>
                                    <td class="ap-dt-col-1 whitespace-nowrap px-2.5 py-1.5 font-mono text-[10px]">{{ $o[0] }}</td>
                                    <td class="ap-dt-col-2 whitespace-nowrap px-2.5 py-1.5 text-[11.5px] font-medium">{{ $o[1] }}</td>
                                    <td class="ap-dt-col-3 whitespace-nowrap px-2.5 py-1.5 text-[11px] text-muted-foreground">{{ $o[2] }}</td>
                                    <td class="ap-dt-col-4 whitespace-nowrap px-2.5 py-1.5 text-[11px] text-muted-foreground">{{ $o[6] }}</td>
                                    <td class="ap-dt-col-5 whitespace-nowrap px-2.5 py-1.5 text-right font-mono text-[10.5px]" data-num="{{ $o[3] }}">Rp {{ number_format($o[3], 0, ',', '.') }}</td>
                                    <td class="ap-dt-col-6 px-2.5 py-1.5"><span class="rounded bg-{{ $o[5] }}-500/15 px-1.5 py-px text-[10px] font-medium text-{{ $o[5] }}-600 dark:text-{{ $o[5] }}-400">{{ $o[4] }}</span></td>
                                </tr>
                            @endforeach
                            <tr class="ap-dt-empty hidden">
                                <td colspan="7" class="px-2.5 py-6 text-center text-[11px] text-muted-foreground" data-testid="dt2-empty">Tidak ada invoice yang cocok.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-2 border-t border-border bg-muted px-2.5 py-1.5">
                    <span class="font-mono text-[9.5px] uppercase tracking-[0.1em] text-muted-foreground" data-testid="dt2-info">&nbsp;</span>
                    <span class="font-mono text-[9.5px] uppercase tracking-[0.1em] text-muted-foreground" data-testid="dt2-selected">0 dipilih</span>
                </div>
            </div>
        </x-panel>

        {{-- 3. Summary datatable --}}
        <x-panel id="dt-summary" title="Datatable ringkasan" hint="bar inline &middot; baris total">
            <div class="overflow-hidden rounded-md border border-border">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left" data-testid="dt3-table">
                        <thead class="bg-muted">
                            <tr>
                                <th class="px-2.5 py-1.5 font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground">Halaman</th>
                                <th class="px-2.5 py-1.5 text-right font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground">Tayangan</th>
                                <th class="w-40 px-2.5 py-1.5 font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground">Distribusi</th>
                                <th class="px-2.5 py-1.5 text-right font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground">Bounce</th>
                                <th class="px-2.5 py-1.5 text-right font-mono text-[9px] font-medium uppercase tracking-[0.12em] text-muted-foreground">Durasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border bg-surface">
                            @php $total = collect($traffic)->sum(fn ($t) => $t[1]); $max = collect($traffic)->max(fn ($t) => $t[1]); @endphp
                            @foreach ($traffic as $t)
                                <tr class="transition-colors hover:bg-muted">
                                    <td class="whitespace-nowrap px-2.5 py-1.5 font-mono text-[10.5px]">{{ $t[0] }}</td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5 text-right font-mono text-[10.5px]">{{ number_format($t[1], 0, ',', '.') }}</td>
                                    <td class="px-2.5 py-1.5">
                                        <div class="flex items-center gap-1.5">
                                            <div class="h-1 flex-1 overflow-hidden rounded-full bg-muted">
                                                <div class="h-full rounded-full bg-{{ $t[4] }}-500" style="width: {{ round($t[1] / $max * 100) }}%"></div>
                                            </div>
                                            <span class="w-7 text-right font-mono text-[9px] text-muted-foreground">{{ round($t[1] / $total * 100) }}%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5 text-right font-mono text-[10.5px] text-muted-foreground">{{ $t[2] }}%</td>
                                    <td class="whitespace-nowrap px-2.5 py-1.5 text-right font-mono text-[10.5px] text-muted-foreground">{{ number_format($t[3], 1, ',', '.') }} mnt</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t border-border bg-muted">
                                <td class="px-2.5 py-1.5 font-mono text-[9px] uppercase tracking-[0.12em] text-muted-foreground">Total</td>
                                <td class="px-2.5 py-1.5 text-right font-mono text-[10.5px] font-semibold" data-testid="dt3-total">{{ number_format($total, 0, ',', '.') }}</td>
                                <td class="px-2.5 py-1.5"></td>
                                <td class="px-2.5 py-1.5 text-right font-mono text-[10.5px] font-semibold">48,8%</td>
                                <td class="px-2.5 py-1.5 text-right font-mono text-[10.5px] font-semibold">2,1 mnt</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <p class="ap-help text-[10px] text-muted-foreground">Baris total memakai latar muted agar terpisah jelas dari data.</p>
        </x-panel>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/datatable.js') }}"></script>
@endpush
