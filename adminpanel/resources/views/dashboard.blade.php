@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="p-3 sm:p-4" data-testid="dashboard-page">

    <div class="mb-3 flex flex-wrap items-end justify-between gap-2">
        <div>
            <h1 class="ap-h1" data-testid="page-title">Dashboard</h1>
            <p class="ap-p mt-1.5">Ruang kerja masih kosong &mdash; siap diisi modul pertama Anda.</p>
        </div>
        <div class="flex items-center gap-1.5">
            <button type="button" data-testid="refresh-btn"
                    class="flex h-7 items-center gap-1.5 rounded-md border border-border bg-surface px-2.5 text-[11.5px] font-medium text-muted-foreground transition-colors hover:text-foreground active:scale-[0.98]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                </svg>
                Muat ulang
            </button>
            <button type="button" data-testid="new-item-btn"
                    class="flex h-7 items-center gap-1.5 rounded-md bg-primary px-2.5 text-[11.5px] font-medium text-primary-foreground transition-opacity hover:opacity-90 active:scale-[0.98]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Buat baru
            </button>
        </div>
    </div>

    <div class="rise grid-canvas flex min-h-[220px] w-full flex-col sm:min-h-[calc(100vh-11.5rem)] items-center justify-center rounded-lg border border-dashed border-border bg-surface/60 px-4 py-10"
         data-testid="empty-state">
        <div class="flex h-9 w-9 items-center justify-center rounded-lg border border-border bg-surface">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-muted-foreground">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 6v3.776"/>
            </svg>
        </div>
        <p class="mt-2.5 text-[12.5px] font-medium tracking-tight" data-testid="empty-state-title">Belum ada konten</p>
        <p class="mt-1 max-w-[260px] text-center text-[11px] leading-relaxed text-muted-foreground" data-testid="empty-state-desc">
            Halaman placeholder. Tambahkan widget, tabel, atau statistik di sini kapan saja.
        </p>
        <span class="mt-3 rounded border border-border bg-muted px-1.5 py-0.5 font-mono text-[9.5px] uppercase tracking-[0.14em] text-muted-foreground">
            resources/views/dashboard.blade.php
        </span>
    </div>
</div>
@endsection
