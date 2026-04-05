
<slot-layout>
    <section class="bg-white p-6 rounded-md shadow-sm">
        <h2 class="text-2xl font-semibold mb-2">👋 Welcome to the ImpulsePHP Starter Project</h2>
        <p class="text-slate-600 mb-4">This is a small, ready-to-use example application you can clone and extend. It demonstrates a minimal layout, public assets and how to run the app locally.</p>

        <h3 class="mt-4 text-lg font-medium">Quick start</h3>
        <pre class="bg-slate-800 text-slate-100 p-4 rounded-md overflow-auto text-sm">git clone &lt;repo-url&gt; my-project
cd my-project
composer install
npm install # optional, for Tailwind CSS
npm run watch:css # optional, to build/watch css

php -S localhost:8000 -t public</pre>

        <h3 class="mt-4 text-lg font-medium">What you'll find</h3>
        <ul class="list-disc pl-5 text-slate-700">
            <li><strong class="font-semibold">/public</strong> — front controller and served assets</li>
            <li><strong class="font-semibold">/views</strong> — Blade-like templates (layouts and pages)</li>
            <li><strong class="font-semibold">/src</strong> — application PHP code (controllers/pages)</li>
        </ul>

        <p class="mt-4 text-sm text-slate-600">If you have the packages present via Composer, the JS runtime will be linked to <code class="bg-slate-100 px-1 rounded">/impulse.js</code> automatically via the post-install script.</p>
    </section>
</slot-layout>
