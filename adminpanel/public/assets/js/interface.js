/* Nexus Admin Panel — Interface page components */

function apTab(btn, group, index) {
    var map = {
        'tab-u': ['.ap-tab-u', '.ap-pane-u'],
        'tab-p': ['.ap-tab-p', null],
        'seg': ['.ap-seg', null],
        'seg2': ['.ap-seg2', null]
    };
    var sel = map[group];
    var btns = btn.parentElement.querySelectorAll(sel[0]);

    btns.forEach(function (b, i) {
        var on = i === index;

        if (group === 'tab-u') {
            b.classList.toggle('border-foreground', on);
            b.classList.toggle('text-foreground', on);
            b.classList.toggle('border-transparent', !on);
            b.classList.toggle('text-muted-foreground', !on);
        } else if (group === 'seg2') {
            b.classList.toggle('bg-primary', on);
            b.classList.toggle('text-primary-foreground', on);
            b.classList.toggle('bg-surface', !on);
            b.classList.toggle('text-muted-foreground', !on);
        } else {
            b.classList.toggle('bg-surface', on);
            b.classList.toggle('shadow-sm', on);
            b.classList.toggle('text-foreground', on);
            b.classList.toggle('text-muted-foreground', !on);
        }
    });

    if (sel[1]) {
        document.querySelectorAll(sel[1]).forEach(function (p, i) {
            p.classList.toggle('hidden', i !== index);
        });
    }
}

function apAccordion(btn) {
    var panel = btn.nextElementSibling;
    var icon = btn.querySelector('svg');
    var open = !panel.classList.contains('hidden');

    panel.classList.toggle('hidden', open);
    icon.style.transform = open ? '' : 'rotate(90deg)';
}

function apRate(n) {
    document.querySelectorAll('#apStars .ap-star svg').forEach(function (svg, i) {
        var on = i < n;
        svg.setAttribute('fill', on ? 'currentColor' : 'none');
        svg.classList.toggle('text-amber-500', on);
        svg.classList.toggle('text-muted-foreground', !on);
    });
    document.getElementById('apRateLabel').textContent = n + ',0 / 5';
}

function apDemoModal(size, place) {
    var widths = { sm: 'max-w-[300px]', md: 'max-w-[340px]', lg: 'max-w-[560px]' };
    var titles = { sm: 'Modal small', md: 'Modal medium (default)', lg: 'Modal large' };
    var old = document.getElementById('apDemoModal');
    if (old) old.remove();

    var wrap = document.createElement('div');
    wrap.id = 'apDemoModal';
    wrap.className = 'fixed inset-0 z-50 flex justify-center overflow-y-auto bg-black/50 p-3 backdrop-blur-[2px] sm:p-4 '
        + (place === 'top' ? 'items-start pt-8 sm:pt-10' : 'items-center');
    wrap.setAttribute('data-testid', 'modal-demo');
    wrap.setAttribute('data-size', size);
    wrap.setAttribute('data-place', place);

    wrap.innerHTML =
        '<div class="w-full ' + widths[size] + ' overflow-hidden rounded-lg border border-border bg-elevated shadow-2xl" data-testid="modal-demo-box">'
      +   '<div class="flex h-9 items-center justify-between gap-2 border-b border-border px-3">'
      +     '<p class="truncate text-[12px] font-semibold tracking-tight">' + titles[size] + '</p>'
      +     '<button data-testid="modal-demo-close" class="flex h-5 w-5 shrink-0 items-center justify-center rounded text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">'
      +       '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="h-3 w-3"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg>'
      +     '</button>'
      +   '</div>'
      +   '<div class="p-3 text-[11px] leading-relaxed text-muted-foreground">'
      +     'Lebar <span class="font-mono text-foreground">' + widths[size].replace('max-w-', '') + '</span>, posisi '
      +     '<span class="font-mono text-foreground">' + (place === 'top' ? 'atas' : 'tengah') + '</span>. '
      +     'Header 36px, badan padding 12px, footer memakai latar muted dengan tombol di kedua sudut.'
      +   '</div>'
      +   '<div class="flex items-center justify-between gap-1.5 border-t border-border bg-muted px-3 py-2">'
      +     '<button data-testid="modal-demo-cancel" class="h-6 rounded border border-border bg-surface px-2 text-[11px] font-medium text-muted-foreground transition-colors hover:text-foreground">Batal</button>'
      +     '<button data-testid="modal-demo-submit" class="h-6 rounded bg-primary px-2 text-[11px] font-medium text-primary-foreground">Konfirmasi</button>'
      +   '</div>'
      + '</div>';

    var close = function () { wrap.remove(); };
    wrap.querySelector('[data-testid="modal-demo-close"]').onclick = close;
    wrap.querySelector('[data-testid="modal-demo-cancel"]').onclick = close;
    wrap.querySelector('[data-testid="modal-demo-submit"]').onclick = function () {
        close();
        apToast('Dikonfirmasi.', 'emerald');
    };
    wrap.onclick = function (e) { if (e.target === wrap) close(); };

    document.body.appendChild(wrap);
}
