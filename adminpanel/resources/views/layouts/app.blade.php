<!DOCTYPE html>
<html lang="id" class="h-full overflow-hidden scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') &middot; {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Geist+Mono:wght@100..900&display=swap" rel="stylesheet">

    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @stack('styles')
</head>
<body class="h-full overflow-hidden bg-background font-sans text-xs text-foreground antialiased">

<div class="flex h-full overflow-hidden" id="shell" data-collapsed="false">

    {{-- ── Sidebar ───────────────────────────────────────────── --}}
    <aside id="sidebar"
           data-testid="sidebar"
           class="z-30 w-52 shrink-0 flex-col border-r border-border bg-surface transition-[width] duration-300 ease-in-out max-md:fixed max-md:inset-y-0 max-md:left-0 max-md:hidden md:flex md:w-52">

        <div class="flex h-12 shrink-0 items-center gap-2.5 border-b border-border px-3">
            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-[7px] bg-primary text-primary-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-[15px] w-[15px]">
                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002a.75.75 0 0 1-.688 0 50.01 50.01 0 0 0-3.15-1.4l-.001 6.096c.99.24 1.96.535 2.907.883a.75.75 0 0 0 .518 0 49.28 49.28 0 0 1 6.209-1.899.75.75 0 0 1 .878.75v3.126a.75.75 0 0 1-.6.735 47.7 47.7 0 0 0-6.633 1.972.75.75 0 0 1-.51 0 47.7 47.7 0 0 0-6.633-1.972.75.75 0 0 1-.6-.735v-3.126a.75.75 0 0 1 .878-.75 49.28 49.28 0 0 1 .653.184V11.03a49.9 49.9 0 0 0-2.35 1.026.75.75 0 0 1-.69-1.333A60.653 60.653 0 0 1 11.7 2.805Z"/>
                </svg>
            </div>
            <div class="sb-label min-w-0 flex-1 overflow-hidden">
                <p class="truncate text-[12.5px] font-semibold leading-[13px] tracking-[-0.01em]">Nexus</p>
                <p class="mt-[3px] truncate font-mono text-[8px] font-medium uppercase leading-[9px] tracking-[0.16em] text-muted-foreground">Admin Panel</p>
            </div>
            <button type="button" onclick="toggleMobileSidebar()" data-testid="sidebar-close" aria-label="Tutup navigasi" class="flex h-6 w-6 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                    <path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="scroll-thin flex-1 overflow-y-auto px-2 py-3" data-testid="sidebar-nav">
            <p class="sb-label mb-1.5 px-2 text-[9px] font-medium uppercase tracking-[0.16em] text-muted-foreground">Umum</p>

            @php
                $nav = [
                    ['dashboard', 'Dashboard', 'M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z'],
                    ['interface', 'Interface', 'M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9'],
                    ['elements', 'Elements', 'M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75'],
                    ['datatable', 'Datatable', 'M3.375 19.5h17.25m0-17.25H3.375m0 4.5h17.25m0 4.125H3.375m0 4.125h17.25M8.25 2.25v17.25m7.5-17.25v17.25'],
                    ['profile.edit', 'Profil', 'M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0A9 9 0 1 0 6.018 18.725m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z'],
                ];
            @endphp

            <div class="space-y-0.5">
                @foreach ($nav as [$route, $label, $path])
                    @php $active = request()->routeIs($route); @endphp
                    <a href="{{ route($route) }}"
                       data-testid="nav-{{ Str::before($route, '.') }}"
                       title="{{ $label }}"
                       class="group relative flex h-8 items-center gap-2.5 rounded-md px-2 text-[11.5px] font-medium transition-colors {{ $active ? 'bg-muted text-foreground' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }}">
                        @if ($active)
                            <span class="absolute left-0 top-1/2 h-4 w-[2px] -translate-y-1/2 rounded-r bg-accent"></span>
                        @endif
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-[15px] w-[15px] shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/>
                        </svg>
                        <span class="sb-label truncate">{{ $label }}</span>
                    </a>
                @endforeach
            </div>
        </nav>

        <div class="shrink-0 border-t border-border p-2">
            <button type="button"
                    data-testid="sidebar-toggle"
                    onclick="toggleSidebar()"
                    class="flex h-7 w-full items-center gap-2.5 rounded-md px-2 text-[11.5px] font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                <svg id="collapseIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-[15px] w-[15px] shrink-0 transition-transform duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5 11.25 12l7.5-7.5M12.75 19.5 5.25 12l7.5-7.5"/>
                </svg>
                <span class="sb-label truncate">Sembunyikan</span>
            </button>
        </div>
    </aside>

    {{-- ── Main ──────────────────────────────────────────────── --}}
    <div class="flex min-w-0 flex-1 flex-col">

        <header class="flex h-12 shrink-0 items-center gap-2 border-b border-border bg-surface px-2.5 sm:px-4" data-testid="topbar">
            <button type="button"
                    data-testid="mobile-menu-btn"
                    onclick="toggleMobileSidebar()"
                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-muted hover:text-foreground md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>

            <nav class="flex min-w-0 items-center gap-1.5" data-testid="breadcrumb">
                <span class="hidden text-[11.5px] text-muted-foreground sm:inline">Nexus</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="hidden h-3 w-3 text-muted-foreground/60 sm:block">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="truncate text-[11.5px] font-medium text-foreground">@yield('breadcrumb', 'Dashboard')</span>
            </nav>

            <div class="ml-auto flex shrink-0 items-center gap-1 sm:gap-1.5">
                <div class="relative hidden md:block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="pointer-events-none absolute left-2 top-1/2 h-3.5 w-3.5 -translate-y-1/2 text-muted-foreground">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                    <input id="searchInput" type="text" placeholder="Cari&hellip;"
                           data-testid="search-input"
                           class="h-7 w-36 rounded-md border border-border bg-background pl-7 pr-10 text-[11.5px] text-foreground placeholder:text-muted-foreground focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40 lg:w-56">
                    <kbd class="pointer-events-none absolute right-1.5 top-1/2 -translate-y-1/2 rounded border border-border bg-muted px-1 py-0.5 font-mono text-[9px] text-muted-foreground">&#8984;K</kbd>
                </div>

                <button type="button" data-testid="theme-toggle"
                        onclick="apToggleTheme()"
                        class="flex h-7 w-7 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="hidden h-4 w-4 dark:block">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4 dark:hidden">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
                    </svg>
                </button>

                <button type="button" data-testid="notifications-btn"
                        class="relative hidden h-7 w-7 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-muted hover:text-foreground sm:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                    </svg>
                    <span class="absolute right-1 top-1 h-1.5 w-1.5 rounded-full bg-accent ring-2 ring-surface"></span>
                </button>

                <div class="mx-0.5 hidden h-4 w-px bg-border sm:block"></div>

                <div class="relative">
                    <button type="button" data-testid="user-menu-btn" onclick="toggleUserMenu(event)"
                            class="flex h-7 items-center gap-1.5 rounded-md pl-0.5 pr-1 transition-colors hover:bg-muted sm:pr-1.5">
                        @if (auth()->user()->avatar_path)
                            <img src="{{ asset('storage/'.auth()->user()->avatar_path) }}" alt="" class="h-6 w-6 shrink-0 rounded-md object-cover" data-testid="topbar-avatar">
                        @else
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-primary text-[10px] font-semibold text-primary-foreground">{{ Str::upper(Str::substr(auth()->user()->name, 0, 2)) }}</span>
                        @endif
                        <span class="hidden max-w-[110px] truncate text-[11.5px] font-medium lg:block">{{ auth()->user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3 text-muted-foreground">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>

                    <div id="userMenu" data-testid="user-menu"
                         class="absolute right-0 top-9 z-50 hidden w-44 overflow-hidden rounded-lg border border-border bg-elevated p-1 shadow-xl shadow-black/5">
                        <div class="px-2 py-1.5">
                            <p class="truncate text-[11.5px] font-medium leading-tight">{{ auth()->user()->name }}</p>
                            <p class="truncate font-mono text-[9.5px] text-muted-foreground">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="my-1 h-px bg-border"></div>
                        <a href="{{ route('profile.edit') }}" data-testid="menu-profile" class="flex h-7 w-full items-center gap-2 rounded px-2 text-[11.5px] text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                            Profil
                        </a>
                        <button type="button" data-testid="menu-settings" class="flex h-7 w-full items-center gap-2 rounded px-2 text-[11.5px] text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            Pengaturan
                        </button>
                        <div class="my-1 h-px bg-border"></div>
                        <form method="POST" action="{{ route('logout') }}" data-testid="logout-form">
                            @csrf
                            <button type="submit" data-testid="menu-logout" class="flex h-7 w-full items-center gap-2 rounded px-2 text-[11.5px] text-red-600 transition-colors hover:bg-red-500/10 dark:text-red-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="scroll-thin flex-1 overflow-y-auto overflow-x-hidden" data-testid="main-content">
            @yield('content')
        </main>

        <footer class="flex h-7 shrink-0 items-center gap-3 border-t border-border bg-surface px-2.5 font-mono text-[9.5px] uppercase tracking-[0.12em] text-muted-foreground sm:px-4">
            <span class="flex items-center gap-1.5">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>sqlite&nbsp;connected
            </span>
            <span class="hidden sm:inline">laravel&nbsp;{{ app()->version() }}</span>
            <span class="ml-auto hidden sm:inline">php&nbsp;{{ PHP_VERSION }}</span>
        </footer>
    </div>
</div>

<div id="mobileOverlay" data-testid="sidebar-backdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 z-20 hidden bg-black/50 backdrop-blur-[2px] md:hidden"></div>

<div id="apToasts" class="pointer-events-none fixed bottom-10 right-2.5 z-[60] flex w-[240px] max-w-[calc(100vw-20px)] flex-col gap-1.5 sm:bottom-10 sm:right-4" data-testid="toast-container"></div>

<script src="{{ asset('assets/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
