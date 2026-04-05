<?php $translator = \Impulse\Core\App::get(\Impulse\Translation\Contract\TranslatorInterface::class); ?>

<slot-layout>
    <section class="bg-white p-6 rounded-md shadow-sm">
        <h2 class="text-2xl font-semibold mb-2"><?= htmlspecialchars($translator->trans('messages.page.title'), ENT_QUOTES, 'UTF-8') ?></h2>
        <p class="text-slate-600 mb-4"><?= htmlspecialchars($translator->trans('messages.page.description'), ENT_QUOTES, 'UTF-8') ?></p>

        <h3 class="mt-4 text-lg font-medium"><?= htmlspecialchars($translator->trans('messages.page.quick_start'), ENT_QUOTES, 'UTF-8') ?></h3>
        <pre class="bg-slate-800 text-slate-100 p-4 rounded-md overflow-auto text-sm"><?= htmlspecialchars($translator->trans('messages.page.commands'), ENT_QUOTES, 'UTF-8') ?></pre>

        <h3 class="mt-4 text-lg font-medium"><?= htmlspecialchars($translator->trans('messages.page.what_you_find'), ENT_QUOTES, 'UTF-8') ?></h3>
        <ul class="list-disc pl-5 text-slate-700">
            <li><strong class="font-semibold"><?= htmlspecialchars($translator->trans('messages.page.what_public_title'), ENT_QUOTES, 'UTF-8') ?></strong> <?= htmlspecialchars($translator->trans('messages.page.what_public'), ENT_QUOTES, 'UTF-8') ?></li>
            <li><strong class="font-semibold"><?= htmlspecialchars($translator->trans('messages.page.what_views_title'), ENT_QUOTES, 'UTF-8') ?></strong> <?= htmlspecialchars($translator->trans('messages.page.what_views'), ENT_QUOTES, 'UTF-8') ?></li>
            <li><strong class="font-semibold"><?= htmlspecialchars($translator->trans('messages.page.what_src_title'), ENT_QUOTES, 'UTF-8') ?></strong> <?= htmlspecialchars($translator->trans('messages.page.what_src'), ENT_QUOTES, 'UTF-8') ?></li>
        </ul>

        <p class="mt-4 text-sm text-slate-600"><?= htmlspecialchars($translator->trans('messages.page.runtime_note'), ENT_QUOTES, 'UTF-8') ?></p>
    </section>
</slot-layout>
