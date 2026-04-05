<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? 'ImpulsePHP — Project' }}</title>
    <!-- Link to compiled CSS (Tailwind output) if available -->
    <link rel="stylesheet" href="/css/main.css" />
    <style>
        /* Minimal fallback styles when no CSS is present */
        :root{color-scheme: light}
        body{font-family: system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,"Apple Color Emoji","Segoe UI Emoji";background:#f8fafc;color:#0f172a;margin:0}
        .container{max-width:1100px;margin:0 auto;padding:2rem}
        header{display:flex;justify-content:space-between;align-items:center;padding-bottom:1rem}
        nav a{margin-left:1rem;color:#2563eb;text-decoration:none}
        footer{color:#64748b;padding-top:2rem;font-size:.9rem}
        pre{background:#0f172a;color:#e6eef8;padding:1rem;border-radius:.5rem;overflow:auto}
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1 style="margin:0;font-size:1.25rem;font-weight:700">ImpulsePHP Project</h1>
                <div style="font-size:.9rem;color:#475569">A minimal starter project based on ImpulsePHP</div>
            </div>
            <nav>
                <a href="/">Home</a>
                <a href="/docs">Docs</a>
                <a href="https://github.com/impulsephp" target="_blank" rel="noopener">GitHub</a>
            </nav>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer>
            <div>Made with ❤️ — ImpulsePHP</div>
            <div style="margin-top:.5rem">Public files served from <code>/public</code>. Run <code>php -S localhost:8000 -t public</code> to test locally.</div>
        </footer>
    </div>

    <script src="/impulse.js"></script>
</body>
</html>
