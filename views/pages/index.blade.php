<slot-layout>
    <section>
        <h2 style="font-size:1.5rem;margin:0 0 .5rem">👋 Welcome to the ImpulsePHP Starter Project</h2>
        <p style="margin:0 0 1rem;color:#475569">This is a small, ready-to-use example application you can clone and extend. It demonstrates a minimal layout, public assets and how to run the app locally.</p>

        <h3 style="margin-top:1rem">Quick start</h3>
        <pre>git clone &lt;repo-url&gt; my-project
cd my-project
composer install
npm install # optional, for Tailwind CSS
npm run watch:css # optional, to build/watch css

php -S localhost:8000 -t public</pre>

        <h3>What you'll find</h3>
        <ul>
            <li><strong>/public</strong> — front controller and served assets</li>
            <li><strong>/views</strong> — Blade-like templates (layouts and pages)</li>
            <li><strong>/src</strong> — application PHP code (controllers/pages)</li>
        </ul>

        <p>If you have the packages present via Composer, the JS runtime will be linked to <code>/impulse.js</code> automatically via the post-install script.</p>
    </section>
</slot-layout>
