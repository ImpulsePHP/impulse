<div class="mx-auto max-w-5xl py-8 px-4 sm:px-6 lg:px-8">
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-rose-600">Zone admin</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Administration ACL</h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">
            Cette route est protégée par l'ability <code>admin.access</code> et n'est accessible
            qu'aux comptes <strong>ROLE_ADMIN</strong>.
        </p>
        <div class="mt-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Rôle</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">ROLE_USER</p>
                <p class="mt-2 text-sm text-slate-600">Accès au dashboard personnel.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Rôle</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">ROLE_FLEET_MANAGER</p>
                <p class="mt-2 text-sm text-slate-600">Supervision du parc et édition des véhicules.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Rôle</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">ROLE_ADMIN</p>
                <p class="mt-2 text-sm text-slate-600">Accès complet, y compris suppression.</p>
            </div>
        </div>
    </div>
</div>
