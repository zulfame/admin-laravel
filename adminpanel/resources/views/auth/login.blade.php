<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk &middot; {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Geist+Mono:wght@100..900&display=swap" rel="stylesheet">

    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="grid-canvas flex min-h-full items-center justify-center bg-background px-4 py-8 font-sans text-xs text-foreground">

<button type="button" data-testid="theme-toggle" onclick="apToggleTheme()"
        class="fixed right-3 top-3 flex h-7 w-7 items-center justify-center rounded-md border border-border bg-surface text-muted-foreground transition-colors hover:text-foreground">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="hidden h-4 w-4 dark:block">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4 dark:hidden">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
    </svg>
</button>

<div class="rise w-full max-w-[340px]" data-testid="login-page">

    <div class="mb-4 flex items-center gap-2.5">
        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-[7px] bg-primary text-primary-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-[15px] w-[15px]">
                <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002a.75.75 0 0 1-.688 0 50.01 50.01 0 0 0-3.15-1.4l-.001 6.096c.99.24 1.96.535 2.907.883a.75.75 0 0 0 .518 0 49.28 49.28 0 0 1 6.209-1.899.75.75 0 0 1 .878.75v3.126a.75.75 0 0 1-.6.735 47.7 47.7 0 0 0-6.633 1.972.75.75 0 0 1-.51 0 47.7 47.7 0 0 0-6.633-1.972.75.75 0 0 1-.6-.735v-3.126a.75.75 0 0 1 .878-.75 49.28 49.28 0 0 1 .653.184V11.03a49.9 49.9 0 0 0-2.35 1.026.75.75 0 0 1-.69-1.333A60.653 60.653 0 0 1 11.7 2.805Z"/>
            </svg>
        </div>
        <div class="min-w-0">
            <p class="truncate text-[12.5px] font-semibold leading-[13px] tracking-[-0.01em]">Nexus</p>
            <p class="mt-[3px] truncate font-mono text-[8px] font-medium uppercase leading-[9px] tracking-[0.16em] text-muted-foreground">Admin Panel</p>
        </div>
    </div>

    <div class="rounded-lg border border-border bg-surface p-4 shadow-sm">
        <h1 class="text-[14px] font-semibold leading-none tracking-tight" data-testid="login-title">Masuk ke panel</h1>
        <p class="mt-1.5 text-[11px] text-muted-foreground">Akses dibatasi hanya untuk administrator.</p>

        @if (session('status'))
            <div class="mt-3 flex items-start gap-1.5 rounded-md border border-border bg-muted px-2 py-1.5 text-[11px] text-muted-foreground" data-testid="login-status">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="mt-px h-3.5 w-3.5 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                {{ session('status') }}
            </div>
        @endif

        @error('email')
            <div class="shake mt-3 flex items-start gap-1.5 rounded-md border border-red-500/30 bg-red-500/10 px-2 py-1.5 text-[11px] text-red-600 dark:text-red-400" data-testid="login-error">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="mt-px h-3.5 w-3.5 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                {{ $message }}
            </div>
        @enderror

        <form method="POST" action="{{ route('login.store') }}" class="mt-3.5 space-y-3" data-testid="login-form">
            @csrf

            <div>
                <label for="email" class="ap-label">Email</label>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="ap-input-icon"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 9.409a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    <input id="email" name="email" type="email" required autofocus autocomplete="username"
                           value="{{ old('email') }}" placeholder="admin@nexus.local"
                           data-testid="login-email" class="ap-input !h-8 !pl-7">
                </div>
            </div>

            <div>
                <label for="password" class="ap-label">Kata sandi</label>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="ap-input-icon"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                           placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                           data-testid="login-password" class="ap-input !h-8 !pl-7 !pr-8">
                    <button type="button" onclick="apLoginPw()" data-testid="toggle-password"
                            class="absolute right-1 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded text-muted-foreground transition-colors hover:text-foreground">
                        <svg id="pwOn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        <svg id="pwOff" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="hidden h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243"/></svg>
                    </button>
                </div>
            </div>

            <label class="flex cursor-pointer items-center gap-1.5 text-[11px] text-muted-foreground">
                <input type="checkbox" name="remember" value="1" data-testid="login-remember"
                       class="h-3 w-3 rounded border-border bg-background text-accent focus:ring-1 focus:ring-accent/40">
                Ingat saya di perangkat ini
            </label>

            <button type="submit" data-testid="login-submit"
                    class="flex h-8 w-full items-center justify-center gap-1.5 rounded-md bg-primary text-[11.5px] font-medium text-primary-foreground transition-opacity hover:opacity-90 active:scale-[0.99]">
                Masuk
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            </button>
        </form>
    </div>

    <p class="mt-3 text-center font-mono text-[9.5px] uppercase tracking-[0.14em] text-muted-foreground" data-testid="login-footer">
        laravel {{ app()->version() }} &middot; guard web &middot; sqlite
    </p>
</div>

<script>
    function apLoginPw() {
        var i = document.getElementById('password');
        var hidden = i.type === 'password';
        i.type = hidden ? 'text' : 'password';
        document.getElementById('pwOn').classList.toggle('hidden', hidden);
        document.getElementById('pwOff').classList.toggle('hidden', !hidden);
    }
</script>
</body>
</html>
