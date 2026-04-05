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
    <?php $translator = \Impulse\Core\App::get(\Impulse\Translation\Contract\TranslatorInterface::class); ?>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <header class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold leading-tight"><?= htmlspecialchars($translator->trans('messages.layout.project'), ENT_QUOTES, 'UTF-8') ?></h1>
                <div class="text-sm text-slate-500"><?= htmlspecialchars($translator->trans('messages.layout.subtitle'), ENT_QUOTES, 'UTF-8') ?></div>
            </div>

            <nav class="space-x-4 text-sm">
                <a href="https://github.com/impulsephp" target="_blank" rel="noopener" class="text-indigo-600 hover:underline"><?= htmlspecialchars($translator->trans('messages.layout.nav.github'), ENT_QUOTES, 'UTF-8') ?></a>
            </nav>
        </header>

        <main class="mt-6">
            {{ $slot }}
        </main>

        <footer class="mt-10 text-sm text-slate-500">
            <div><?= htmlspecialchars($translator->trans('messages.layout.footer.made_with'), ENT_QUOTES, 'UTF-8') ?></div>
            <div class="mt-2"><?= htmlspecialchars($translator->trans('messages.layout.footer.serve_note', ['cmd' => 'php -S localhost:8000 -t public']), ENT_QUOTES, 'UTF-8') ?></div>
        </footer>
    </div>

    <script src="/impulse.js"></script>
</body>
</html>
