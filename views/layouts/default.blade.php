<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? 'ImpulsePHP — Project' }}</title>
    <!-- Tailwind CSS output (public/css/main.css) -->
    <link rel="stylesheet" href="/css/main.css" />
    <!-- Minimal fallback for environments without Tailwind: keep sensible defaults in the CSS file instead -->
</head>
<body class="antialiased bg-slate-50 text-slate-900">
    <div class="max-w-5xl mx-auto px-4 py-8">
        <header class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold leading-tight">ImpulsePHP Project</h1>
                <div class="text-sm text-slate-500">A minimal starter project based on ImpulsePHP</div>
            </div>

            <nav class="space-x-4 text-sm">
                <a href="https://github.com/impulsephp" target="_blank" rel="noopener" class="text-indigo-600 hover:underline">GitHub</a>
            </nav>
        </header>

        <main class="mt-6">
            {{ $slot }}
        </main>

        <footer class="mt-10 text-sm text-slate-500">
            <div>Made with <span aria-hidden="true">❤️</span> — ImpulsePHP</div>
            <div class="mt-2">Public files served from <code class="bg-slate-100 px-1 rounded">/public</code>. Run <code class="bg-slate-100 px-1 rounded">php -S localhost:8000 -t public</code> to test locally.</div>
        </footer>
    </div>

    <script src="/impulse.js"></script>
</body>
</html>
