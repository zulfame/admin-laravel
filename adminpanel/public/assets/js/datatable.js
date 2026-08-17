/* Nexus Admin Panel — Datatable page (search, sort, paginate, columns) */

var apDt = (function () {
    var state = {};

    function ctx(id) {
        if (!state[id]) {
            var table = document.getElementById(id);
            state[id] = {
                table: table,
                rows: Array.prototype.slice.call(table.querySelectorAll('.ap-dt-row')),
                empty: table.querySelector('.ap-dt-empty'),
                query: '',
                status: '',
                page: 1,
                perPage: id === 'dt1' ? 5 : 0,
                sortCol: null,
                sortDir: 1
            };
        }
        return state[id];
    }

    function matches(c, row) {
        var okQuery = !c.query || row.textContent.toLowerCase().indexOf(c.query) !== -1;
        var okStatus = !c.status || row.dataset.status === c.status;
        return okQuery && okStatus;
    }

    function count(id) {
        var c = ctx(id);
        var picked = c.rows.filter(function (r) {
            var box = r.querySelector('.ap-dt-check');
            return box && box.checked;
        }).length;

        var el = document.querySelector('[data-testid="' + id + '-selected"]');
        if (el) el.textContent = picked + ' dipilih';
    }

    function render(id) {
        var c = ctx(id);
        var visible = c.rows.filter(function (r) { return matches(c, r); });
        var pages = c.perPage ? Math.max(1, Math.ceil(visible.length / c.perPage)) : 1;
        if (c.page > pages) c.page = pages;

        var start = c.perPage ? (c.page - 1) * c.perPage : 0;
        var end = c.perPage ? start + c.perPage : visible.length;

        c.rows.forEach(function (r) { r.classList.add('hidden'); });
        visible.slice(start, end).forEach(function (r) { r.classList.remove('hidden'); });
        if (c.empty) c.empty.classList.toggle('hidden', visible.length > 0);

        var info = document.querySelector('[data-testid="' + id + '-info"]');
        if (info) {
            info.textContent = visible.length
                ? 'Menampilkan ' + (start + 1) + '-' + Math.min(end, visible.length) + ' dari ' + visible.length + ' baris'
                : '0 baris';
        }

        var pager = document.querySelector('[data-testid="' + id + '-pager"]');
        if (pager && c.perPage) {
            pager.innerHTML = '';

            var mk = function (label, page, disabled, active) {
                var b = document.createElement('button');
                b.type = 'button';
                b.textContent = label;
                b.setAttribute('data-testid', id + '-page-' + label.toLowerCase());
                b.className = 'h-6 min-w-6 rounded border px-1.5 text-[10.5px] font-medium transition-colors '
                    + (active ? 'border-transparent bg-primary text-primary-foreground'
                              : 'border-border bg-surface text-muted-foreground hover:text-foreground')
                    + (disabled ? ' cursor-not-allowed opacity-40' : '');
                if (!disabled && !active) b.onclick = function () { c.page = page; render(id); };
                return b;
            };

            pager.appendChild(mk('‹', c.page - 1, c.page === 1, false));
            for (var p = 1; p <= pages; p++) pager.appendChild(mk(String(p), p, false, p === c.page));
            pager.appendChild(mk('›', c.page + 1, c.page === pages, false));
        }

        count(id);
    }

    return {
        search: function (id, q) {
            var c = ctx(id);
            c.query = q.toLowerCase();
            c.page = 1;
            render(id);
        },

        filter: function (id, status, btn) {
            var c = ctx(id);
            c.status = status;
            c.page = 1;

            btn.parentElement.querySelectorAll('.ap-dt-filter').forEach(function (b) {
                b.classList.remove('bg-surface', 'shadow-sm', 'text-foreground');
                b.classList.add('text-muted-foreground');
            });
            btn.classList.add('bg-surface', 'shadow-sm', 'text-foreground');
            btn.classList.remove('text-muted-foreground');
            render(id);
        },

        perPage: function (id, n) {
            var c = ctx(id);
            c.perPage = parseInt(n, 10);
            c.page = 1;
            render(id);
        },

        sort: function (id, col, btn, type) {
            var c = ctx(id);
            c.sortDir = c.sortCol === col ? -c.sortDir : 1;
            c.sortCol = col;

            c.table.querySelectorAll('.ap-dt-sort').forEach(function (b) {
                var arrow = b.querySelector('.ap-dt-arrow');
                b.classList.remove('text-foreground');
                arrow.classList.add('opacity-0');
                arrow.style.transform = '';
            });

            btn.classList.add('text-foreground');
            var arrow = btn.querySelector('.ap-dt-arrow');
            arrow.classList.remove('opacity-0');
            arrow.style.transform = c.sortDir === 1 ? '' : 'rotate(180deg)';

            var body = c.rows[0].parentElement;
            c.rows.sort(function (a, b) {
                var ca = a.children[col], cb = b.children[col];
                if (type === 'num') return (parseFloat(ca.dataset.num) - parseFloat(cb.dataset.num)) * c.sortDir;
                return ca.textContent.trim().localeCompare(cb.textContent.trim(), 'id') * c.sortDir;
            });
            c.rows.forEach(function (r) { body.appendChild(r); });
            if (c.empty) body.appendChild(c.empty);
            render(id);
        },

        column: function (id, col, show) {
            document.getElementById(id).querySelectorAll('.ap-dt-col-' + col).forEach(function (cell) {
                cell.classList.toggle('hidden', !show);
            });
        },

        selectAll: function (id, checked) {
            var c = ctx(id);
            c.rows.forEach(function (r) {
                if (r.classList.contains('hidden')) return;
                var box = r.querySelector('.ap-dt-check');
                if (box) box.checked = checked;
            });
            count(id);
        },

        count: count,
        init: function (id) { render(id); }
    };
})();

apDt.init('dt1');
apDt.init('dt2');
