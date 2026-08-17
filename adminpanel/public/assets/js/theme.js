/* Nexus Admin Panel — theme bootstrap (runs before paint to avoid FOUC) */
(function () {
    var stored = localStorage.getItem('ap-theme');
    var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (stored === 'dark' || (!stored && prefersDark)) {
        document.documentElement.classList.add('dark');
    }
})();

function apToggleTheme() {
    var root = document.documentElement;
    root.classList.toggle('dark');
    localStorage.setItem('ap-theme', root.classList.contains('dark') ? 'dark' : 'light');
}
