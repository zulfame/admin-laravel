@props(['id' => null, 'title' => '', 'hint' => null])

<section @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge(['class' => 'scroll-mt-3 flex flex-col overflow-hidden rounded-lg border border-border bg-surface']) }}
    data-testid="panel-{{ $id }}">

    <div class="flex h-9 shrink-0 items-center gap-2 border-b border-border px-2.5" data-testid="panel-header-{{ $id }}">
        <h2 class="ap-h3 shrink-0 font-semibold">{!! $title !!}</h2>
        @if ($hint)
            <span class="hidden truncate font-mono text-[9px] uppercase tracking-[0.12em] text-muted-foreground sm:inline">{!! $hint !!}</span>
        @endif
        @if ($id)
            <a href="#{{ $id }}" class="ml-auto hidden shrink-0 font-mono text-[9px] text-muted-foreground transition-colors hover:text-accent sm:block">#{{ $id }}</a>
        @endif
    </div>

    <div class="flex-1 space-y-2.5 p-2.5">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="flex h-9 shrink-0 flex-wrap items-center justify-between gap-2 border-t border-border bg-muted px-2.5" data-testid="panel-footer-{{ $id }}">
            {{ $footer }}
        </div>
    @endisset
</section>
