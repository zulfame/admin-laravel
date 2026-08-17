/* Nexus Admin Panel — Elements page form behaviour */

function apCopy(id) {
    var el = document.getElementById(id);
    if (navigator.clipboard) navigator.clipboard.writeText(el.value).catch(function () {});
    apToast('Disalin ke papan klip.', 'emerald');
}

function apPwToggle(id) {
    var i = document.getElementById(id);
    i.type = i.type === 'password' ? 'text' : 'password';
}

function apStrength(v) {
    var score = 0;
    if (v.length >= 8) score++;
    if (/[A-Z]/.test(v)) score++;
    if (/[0-9]/.test(v)) score++;
    if (/[^A-Za-z0-9]/.test(v)) score++;
    if (!v.length) score = 0;

    var tones = ['bg-muted', 'bg-red-500', 'bg-amber-500', 'bg-sky-500', 'bg-emerald-500'];
    var labels = ['kosong', 'lemah', 'sedang', 'baik', 'kuat'];

    document.querySelectorAll('#apPwBars span').forEach(function (bar, i) {
        bar.className = 'h-1 flex-1 rounded-full ' + (i < score ? tones[score] : 'bg-muted');
    });
    document.getElementById('apPwLabel').textContent = labels[score];
}

function apCount(el) {
    el.parentElement.querySelector('[data-testid="char-count"]').textContent = el.value.length + ' / 180';
}

function apStep(delta) {
    var el = document.getElementById('apQty');
    el.value = Math.max(0, parseInt(el.value, 10) + delta);
}

function apGroup(btn) {
    btn.parentElement.querySelectorAll('.ap-group').forEach(function (b) {
        b.className = 'ap-group h-7 border-r border-border px-2 text-[11px] font-medium transition-colors last:border-r-0 bg-surface text-muted-foreground hover:bg-muted';
    });
    btn.className = 'ap-group h-7 border-r border-border px-2 text-[11px] font-medium transition-colors last:border-r-0 bg-primary text-primary-foreground';
}

function apOtp(el) {
    el.value = el.value.replace(/[^0-9]/g, '');
    if (!el.value) return;

    var boxes = Array.prototype.slice.call(document.querySelectorAll('.ap-otp'));
    var next = boxes[boxes.indexOf(el) + 1];
    if (next) next.focus();
}

/* Tags input ------------------------------------------------------------- */
function apTagAdd(input, value) {
    var tag = document.createElement('span');
    tag.className = 'flex items-center gap-1 rounded border border-border bg-muted pl-1.5 pr-1 py-[2px] font-mono text-[9.5px] text-muted-foreground';
    tag.setAttribute('data-testid', 'tag-item');
    tag.innerHTML = '<span></span><button type="button" class="flex h-3 w-3 items-center justify-center rounded-sm transition-colors hover:bg-border hover:text-foreground">'
        + '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2 w-2"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg></button>';
    tag.querySelector('span').textContent = value;
    tag.querySelector('button').onclick = function () { tag.remove(); };
    input.parentElement.insertBefore(tag, input);
}

function apTagKey(e, input) {
    if (e.key === 'Enter') {
        e.preventDefault();
        var val = input.value.trim();
        if (!val) return;
        apTagAdd(input, val);
        input.value = '';
    } else if (e.key === 'Backspace' && !input.value) {
        var last = input.previousElementSibling;
        if (last) last.remove();
    }
}

/* Searchable select (single) --------------------------------------------- */
function apSelToggle(e, id) {
    e.stopPropagation();
    var el = document.getElementById(id);
    var wasHidden = el.classList.contains('hidden');

    apCloseFloating();
    el.classList.toggle('hidden', !wasHidden);

    if (wasHidden) {
        var search = el.querySelector('input');
        search.value = '';
        apSelFilter(id, '');
        search.focus();
    }
}

function apSelFilter(id, q) {
    var menu = document.getElementById(id);
    var query = q.toLowerCase();
    var visible = 0;

    menu.querySelectorAll('.ap-sel-opt').forEach(function (opt) {
        var match = opt.dataset.label.toLowerCase().indexOf(query) !== -1;
        opt.classList.toggle('hidden', !match);
        if (match) visible++;
    });

    menu.querySelector('[data-testid="' + id + '-empty"]').classList.toggle('hidden', visible > 0);
}

function apSelPick(id, btn) {
    var menu = document.getElementById(id);

    menu.querySelectorAll('.ap-sel-opt').forEach(function (opt) {
        opt.classList.remove('bg-muted', 'text-foreground');
        opt.classList.add('text-muted-foreground');
        opt.querySelector('.ap-sel-check').classList.add('hidden');
    });

    btn.classList.add('bg-muted', 'text-foreground');
    btn.classList.remove('text-muted-foreground');
    btn.querySelector('.ap-sel-check').classList.remove('hidden');
    document.getElementById(id + '-label').textContent = btn.dataset.label;
    menu.classList.add('hidden');
}

function apSelKey(e, id) {
    var menu = document.getElementById(id);

    if (e.key === 'Escape') { menu.classList.add('hidden'); return; }
    if (e.key !== 'Enter') return;

    e.preventDefault();
    var first = menu.querySelector('.ap-sel-opt:not(.hidden)');
    if (first) apSelPick(id, first);
}

/* Searchable select (multiple) ------------------------------------------- */
function apMsPick(btn) {
    var on = btn.dataset.on === '1';
    btn.dataset.on = on ? '' : '1';
    btn.querySelector('.ap-sel-check').classList.toggle('hidden', on);
    btn.querySelector('.ap-ms-box').classList.toggle('bg-accent', !on);
    btn.querySelector('.ap-ms-box').classList.toggle('border-accent', !on);
    apMsRender();
}

function apMsClear(e) {
    e.stopPropagation();
    document.querySelectorAll('#ms .ap-sel-opt').forEach(function (opt) {
        if (opt.dataset.on === '1') apMsPick(opt);
    });
}

function apMsRender() {
    var chips = document.getElementById('ms-chips');
    var picked = Array.prototype.slice.call(document.querySelectorAll('#ms .ap-sel-opt')).filter(function (o) {
        return o.dataset.on === '1';
    });

    chips.innerHTML = '';

    picked.forEach(function (opt) {
        var chip = document.createElement('span');
        chip.className = 'flex items-center gap-1 rounded border border-border bg-muted pl-1.5 pr-1 py-[2px] text-[10.5px] font-medium';
        chip.setAttribute('data-testid', 'ms-chip');
        chip.innerHTML = '<span></span><button type="button" class="flex h-3 w-3 items-center justify-center rounded-sm text-muted-foreground transition-colors hover:bg-border hover:text-foreground">'
            + '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2 w-2"><path stroke-linecap="round" d="M6 18 18 6M6 6l12 12"/></svg></button>';
        chip.querySelector('span').textContent = opt.dataset.name;
        chip.querySelector('button').onclick = function (e) { e.stopPropagation(); apMsPick(opt); };
        chips.appendChild(chip);
    });

    document.getElementById('ms-placeholder').classList.toggle('hidden', picked.length > 0);
    document.getElementById('ms-count').textContent = picked.length + ' dipilih';
}

/* Demo seed -------------------------------------------------------------- */
(function () {
    var tagField = document.querySelector('[data-testid="tags-field"]');
    if (tagField) ['produksi', 'billing', 'v2'].forEach(function (t) { apTagAdd(tagField, t); });

    var preselect = document.querySelector('[data-testid="ms-option-1"]');
    if (preselect) apMsPick(preselect);
})();
