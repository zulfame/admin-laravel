/* Nexus Admin Panel — Tailwind CDN configuration (shared by all pages) */
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
                accent: 'var(--accent)'
            },
            fontFamily: {
                sans: ['Geist', 'ui-sans-serif', 'sans-serif'],
                mono: ['Geist Mono', 'ui-monospace', 'monospace']
            }
        }
    }
};
