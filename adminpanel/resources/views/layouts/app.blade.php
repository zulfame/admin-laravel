<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') &middot; {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Geist+Mono:wght@100..900&display=swap" rel="stylesheet">

    <script>
        (function () {
            var t = localStorage.getItem('ap-theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: 'var(--background)',
                        surface: 'var(--surface)',
                        elevated: 'var(--elevated)',
                        border: 'var(--border)',
                        foreground: 'var(--foreground)',
                        muted: 'var(--muted)',
                        'muted-foreground': 'var(--muted-foreground)',
                        primary: 'var(--primary)',
                        'primary-foreground': 'var(--primary-foreground)',
                        accent: 'var(--accent)',
                    },
                    fontFamily: {
                        sans: ['Geist', 'ui-sans-serif', 'sans-serif'],
                        mono: ['Geist Mono', 'ui-monospace', 'monospace'],
                    },
                }
            }
        }
    </script>

    <style>
        :root {
            --background: #F6F6F7;
            --surface: #FFFFFF;
            --elevated: #FFFFFF;
            --border: #E4E4E7;
            --foreground: #0A0A0A;
            --muted: #F0F0F1;
            --muted-foreground: #71717A;
            --primary: #0A0A0A;
            --primary-foreground: #FAFAFA;
            --accent: #2563EB;
            --grid: rgba(9, 9, 11, 0.055);
        }

        .dark {
            --background: #08080A;
            --surface: #101013;
            --elevated: #17171B;
            --border: #232328;
            --foreground: #FAFAFA;
            --muted: #17171B;
            --muted-foreground: #8A8A94;
            --primary: #FAFAFA;
            --primary-foreground: #0A0A0A;
            --accent: #60A5FA;
            --grid: rgba(255, 255, 255, 0.045);
        }

        * { -webkit-font-smoothing: antialiased; }

        body {
            font-feature-settings: "cv11", "ss01";
            font-variation-settings: "opsz" 16;
        }

        ::selection { background: var(--accent); color: #fff; }

        .grid-canvas {
            background-image:
                linear-gradient(to right, var(--grid) 1px, transparent 1px),
                linear-gradient(to bottom, var(--grid) 1px, transparent 1px);
            background-size: 14px 14px;
        }

        .scroll-thin::-webkit-scrollbar { width: 6px; height: 6px; }
        .scroll-thin::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }
        .scroll-thin::-webkit-scrollbar-track { background: transparent; }

        [data-collapsed="true"] .sb-label { opacity: 0; pointer-events: none; }
        .sb-label { transition: opacity .18s ease; }

        @keyframes riseIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }
        .rise { animation: riseIn .45s cubic-bezier(.22,.61,.36,1) both; }
    </style>
</head>
<body class="bg-background text-foreground font-sans text-xs antialiased">

<div class="flex h-screen overflow-hidden" id="shell" data-collapsed="false">

    {{-- ── Sidebar ───────────────────────────────────────────── --}}
    <aside id="sidebar"
           data-testid="sidebar"
           class="relative z-30 hidden w-52 shrink-0 flex-col border-r border-border bg-surface transition-[width] duration-300 ease-in-out md:flex">

        <div class="flex h-12 items-center gap-2 border-b border-border px-3">
            <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-primary text-primary-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-3.5 w-3.5">
                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002a.75.75 0 0 1-.688 0 50.01 50.01 0 0 0-3.15-1.4l-.001 6.096c.99.24 1.96.535 2.907.883a.75.75 0 0 0 .518 0 49.28 49.28 0 0 1 6.209-1.899.75.75 0 0 1 .878.75v3.126a.75.75 0 0 1-.6.735 47.7 47.7 0 0 0-6.633 1.972.75.75 0 0 1-.51 0 47.7 47.7 0 0 0-6.633-1.972.75.75 0 0 1-.6-.735v-3.126a.75.75 0 0 1 .878-.75 49.28 49.28 0 0 1 .653.184V11.03a49.9 49.9 0 0 0-2.35 1.026.75.75 0 0 1-.69-1.333A60.653 60.653 0 0 1 11.7 2.805Z"/>
                </svg>
            </div>
            <div class="sb-label min-w-0 flex-1 overflow-hidden whitespace-nowrap">
                <p class="truncate text-[13px] font-semibold leading-none tracking-tight">Nexus</p>
                <p class="mt-1 truncate font-mono text-[9px] uppercase tracking-[0.14em] text-muted-foreground">admin&nbsp;panel</p>
            </div>
        </div>

        <nav class="scroll-thin flex-1 overflow-y-auto px-2 py-3" data-testid="sidebar-nav">
            <p class="sb-label mb-1.5 px-2 text-[9px] font-medium uppercase tracking-[0.16em] text-muted-foreground">Umum</p>

            <a href="{{ route('dashboard') }}"
               data-testid="nav-dashboard"
               class="group relative flex h-8 items-center gap-2.5 rounded-md bg-muted px-2 text-[11.5px] font-medium text-foreground transition-colors">
                <span class="absolute left-0 top-1/2 h-4 w-[2px] -translate-y-1/2 rounded-r bg-accent"></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-[15px] w-[15px] shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
                </svg>
                <span class="sb-label truncate">Dashboard</span>
            </a>
        </nav>

        <div class="border-t border-border p-2">
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

        <header class="flex h-12 shrink-0 items-center gap-2 border-b border-border bg-surface px-3 sm:px-4" data-testid="topbar">
            <button type="button"
                    data-testid="mobile-menu-btn"
                    onclick="toggleMobileSidebar()"
                    class="flex h-7 w-7 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-muted hover:text-foreground md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>

            <nav class="hidden items-center gap-1.5 sm:flex" data-testid="breadcrumb">
                <span class="text-[11.5px] text-muted-foreground">Nexus</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3 w-3 text-muted-foreground/60">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="text-[11.5px] font-medium text-foreground">@yield('breadcrumb', 'Dashboard')</span>
            </nav>

            <div class="ml-auto flex items-center gap-1.5">
                <div class="relative hidden sm:block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="pointer-events-none absolute left-2 top-1/2 h-3.5 w-3.5 -translate-y-1/2 text-muted-foreground">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                    <input id="searchInput" type="text" placeholder="Cari&hellip;"
                           data-testid="search-input"
                           class="h-7 w-44 rounded-md border border-border bg-background pl-7 pr-10 text-[11.5px] text-foreground placeholder:text-muted-foreground focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent/40 lg:w-60">
                    <kbd class="pointer-events-none absolute right-1.5 top-1/2 -translate-y-1/2 rounded border border-border bg-muted px-1 py-0.5 font-mono text-[9px] text-muted-foreground">&#8984;K</kbd>
                </div>

                <button type="button" data-testid="theme-toggle"
                        onclick="toggleTheme()"
                        class="flex h-7 w-7 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                    <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="hidden h-4 w-4 dark:block">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
                    </svg>
                    <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4 dark:hidden">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
                    </svg>
                </button>

                <button type="button" data-testid="notifications-btn"
                        class="relative flex h-7 w-7 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                    </svg>
                    <span class="absolute right-1 top-1 h-1.5 w-1.5 rounded-full bg-accent ring-2 ring-surface"></span>
                </button>

                <div class="mx-0.5 h-4 w-px bg-border"></div>

                <div class="relative">
                    <button type="button" data-testid="user-menu-btn" onclick="toggleUserMenu(event)"
                            class="flex h-7 items-center gap-1.5 rounded-md pl-0.5 pr-1.5 transition-colors hover:bg-muted">
                        <span class="flex h-6 w-6 items-center justify-center rounded-md bg-primary text-[10px] font-semibold text-primary-foreground">AR</span>
                        <span class="hidden text-[11.5px] font-medium sm:block">Admin</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3 text-muted-foreground">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>

                    <div id="userMenu" data-testid="user-menu"
                         class="absolute right-0 top-9 z-50 hidden w-44 overflow-hidden rounded-lg border border-border bg-elevated p-1 shadow-xl shadow-black/5">
                        <div class="px-2 py-1.5">
                            <p class="text-[11.5px] font-medium leading-tight">Admin Root</p>
                            <p class="truncate font-mono text-[9.5px] text-muted-foreground">admin@nexus.local</p>
                        </div>
                        <div class="my-1 h-px bg-border"></div>
                        <button type="button" data-testid="menu-profile" class="flex h-7 w-full items-center gap-2 rounded px-2 text-[11.5px] text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                            Profil
                        </button>
                        <button type="button" data-testid="menu-settings" class="flex h-7 w-full items-center gap-2 rounded px-2 text-[11.5px] text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.425-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            Pengaturan
                        </button>
                        <div class="my-1 h-px bg-border"></div>
                        <button type="button" data-testid="menu-logout" class="flex h-7 w-full items-center gap-2 rounded px-2 text-[11.5px] text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/></svg>
                            Keluar
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="scroll-thin flex-1 overflow-y-auto" data-testid="main-content">
            @yield('content')
        </main>

        <footer class="flex h-7 shrink-0 items-center gap-3 border-t border-border bg-surface px-3 font-mono text-[9.5px] uppercase tracking-[0.12em] text-muted-foreground sm:px-4">
            <span class="flex items-center gap-1.5">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>sqlite&nbsp;connected
            </span>
            <span class="hidden sm:inline">laravel&nbsp;{{ app()->version() }}</span>
            <span class="ml-auto">php&nbsp;{{ PHP_VERSION }}</span>
        </footer>
    </div>
</div>

<div id="mobileOverlay" onclick="toggleMobileSidebar()" class="fixed inset-0 z-20 hidden bg-black/50 backdrop-blur-[2px] md:hidden"></div>

<script>
    function toggleTheme() {
        var root = document.documentElement;
        root.classList.toggle('dark');
        localStorage.setItem('ap-theme', root.classList.contains('dark') ? 'dark' : 'light');
    }

    function toggleSidebar() {
        var shell = document.getElementById('shell');
        var sb = document.getElementById('sidebar');
        var collapsed = shell.dataset.collapsed === 'true';
        shell.dataset.collapsed = collapsed ? 'false' : 'true';
        sb.classList.toggle('w-52', collapsed);
        sb.classList.toggle('w-14', !collapsed);
        document.getElementById('collapseIcon').style.transform = collapsed ? '' : 'rotate(180deg)';
        localStorage.setItem('ap-sidebar', collapsed ? 'expanded' : 'collapsed');
    }

    function toggleMobileSidebar() {
        var sb = document.getElementById('sidebar');
        var ov = document.getElementById('mobileOverlay');
        var open = !sb.classList.contains('hidden');
        if (open) {
            sb.classList.add('hidden');
            sb.classList.remove('fixed', 'inset-y-0', 'left-0', 'flex');
            ov.classList.add('hidden');
        } else {
            sb.classList.remove('hidden');
            sb.classList.add('fixed', 'inset-y-0', 'left-0', 'flex');
            ov.classList.remove('hidden');
        }
    }

    function toggleUserMenu(e) {
        e.stopPropagation();
        document.getElementById('userMenu').classList.toggle('hidden');
    }

    document.addEventListener('click', function () {
        document.getElementById('userMenu').classList.add('hidden');
    });

    document.addEventListener('keydown', function (e) {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            var i = document.getElementById('searchInput');
            if (i) i.focus();
        }
    });

    if (localStorage.getItem('ap-sidebar') === 'collapsed' && document.getElementById('shell').dataset.collapsed !== 'true') {
        toggleSidebar();
    }
</script>
</body>
</html>
