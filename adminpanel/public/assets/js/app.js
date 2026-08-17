/* Nexus Admin Panel — shared UI behaviour (shell, dropdowns, modals, toasts) */

/* Sidebar ---------------------------------------------------------------- */
function toggleSidebar() {
    var shell = document.getElementById('shell');
    var sb = document.getElementById('sidebar');
    var collapsed = shell.dataset.collapsed === 'true';

    shell.dataset.collapsed = collapsed ? 'false' : 'true';
    sb.classList.toggle('md:w-52', collapsed);
    sb.classList.toggle('md:w-14', !collapsed);
    document.getElementById('collapseIcon').style.transform = collapsed ? '' : 'rotate(180deg)';
    localStorage.setItem('ap-sidebar', collapsed ? 'expanded' : 'collapsed');
}

function toggleMobileSidebar() {
    var sb = document.getElementById('sidebar');
    var ov = document.getElementById('mobileOverlay');
    var open = sb.classList.contains('max-md:flex');

    sb.classList.toggle('max-md:flex', !open);
    sb.classList.toggle('max-md:hidden', open);
    ov.classList.toggle('hidden', open);
}

function closeMobileSidebar() {
    var sb = document.getElementById('sidebar');
    if (sb.classList.contains('max-md:flex')) toggleMobileSidebar();
}

/* User menu -------------------------------------------------------------- */
function toggleUserMenu(e) {
    e.stopPropagation();
    document.getElementById('userMenu').classList.toggle('hidden');
}

/* Dropdowns (shared by Interface, Elements, Datatable) ------------------- */
function apDrop(e, id) {
    e.stopPropagation();
    var el = document.getElementById(id);
    var wasHidden = el.classList.contains('hidden');

    apCloseFloating();
    el.classList.toggle('hidden', !wasHidden);
}

function apCloseFloating() {
    document.querySelectorAll('.ap-drop, .ap-sel').forEach(function (el) {
        el.classList.add('hidden');
    });
}

/* Modals ----------------------------------------------------------------- */
function apModal(id, show) {
    var el = document.getElementById(id);
    if (!el) return;
    el.classList.toggle('hidden', !show);
    el.classList.toggle('flex', show);
}

function apCloseModals() {
    document.querySelectorAll('[data-ap-modal]').forEach(function (el) {
        el.classList.add('hidden');
        el.classList.remove('flex');
    });
    var demo = document.getElementById('apDemoModal');
    if (demo) demo.remove();
}

/* Toasts ----------------------------------------------------------------- */
var apToastIcons = {
    emerald: 'm4.5 12.75 6 6 9-13.5',
    amber: 'M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z',
    red: 'M6 18 18 6M6 6l12 12'
};

function apToast(message, tone) {
    var wrap = document.getElementById('apToasts');
    if (!wrap) return;

    var el = document.createElement('div');
    el.className = 'pointer-events-auto flex items-start gap-2 rounded-md border border-border bg-elevated px-2.5 py-2 shadow-xl shadow-black/10 transition-all duration-300 opacity-0 translate-x-2';
    el.setAttribute('data-testid', 'toast');
    el.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" class="mt-px h-3.5 w-3.5 shrink-0 text-' + tone + '-500">'
        + '<path stroke-linecap="round" stroke-linejoin="round" d="' + apToastIcons[tone] + '"/></svg>'
        + '<p class="min-w-0 flex-1 text-[11px] font-medium leading-snug"></p>';
    el.querySelector('p').textContent = message;
    wrap.appendChild(el);

    requestAnimationFrame(function () { el.classList.remove('opacity-0', 'translate-x-2'); });
    setTimeout(function () {
        el.classList.add('opacity-0', 'translate-x-2');
        setTimeout(function () { el.remove(); }, 300);
    }, 3000);
}

/* Global listeners ------------------------------------------------------- */
document.addEventListener('click', function () {
    var menu = document.getElementById('userMenu');
    if (menu) menu.classList.add('hidden');
    apCloseFloating();
});

document.addEventListener('keydown', function (e) {
    if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
        e.preventDefault();
        var input = document.getElementById('searchInput');
        if (input) input.focus();
    }

    if (e.key === 'Escape') {
        apCloseFloating();
        apCloseModals();
        closeMobileSidebar();
    }
});

document.querySelectorAll('.ap-drop, .ap-sel').forEach(function (el) {
    el.addEventListener('click', function (e) { e.stopPropagation(); });
});

window.addEventListener('resize', function () {
    if (window.innerWidth >= 768) closeMobileSidebar();
});

if (localStorage.getItem('ap-sidebar') === 'collapsed') toggleSidebar();
