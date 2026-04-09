<?php

declare(strict_types=1);

namespace App\Layout\Default;

use Impulse\Core\Attributes\LayoutProperty;
use Impulse\Core\Component\AbstractLayout;
use Impulse\Core\Support\Collector\StyleCollector;

#[LayoutProperty(
    titlePrefix: 'ImpulsePHP'
)]
final class DefaultLayout extends AbstractLayout
{
    /**
     * @throws \JsonException
     */
    public function setup(): void
    {
        StyleCollector::addSheet('/css/main.css');
    }

    public function script(): ?string
    {
        return <<<'JS'
            (() => {
                if ((window).__impulseActionCallPatch) {
                    return;
                }

                (window).__impulseActionCallPatch = true;

                const debounceMap = new WeakMap();
                const throttleMap = new WeakMap();

                const toKebabCase = (value) => value
                    .replace(/([a-z0-9])([A-Z])/g, '$1-$2')
                    .replace(/[\s_]+/g, '-')
                    .toLowerCase();

                const getComponentChain = (element) => {
                    const chain = [];
                    let node = element.closest('[data-impulse-id]');

                    while (node) {
                        const id = node.getAttribute('data-impulse-id');
                        if (id && !chain.includes(id)) {
                            chain.push(id);
                        }

                        node = node.parentElement ? node.parentElement.closest('[data-impulse-id]') : null;
                    }

                    return chain;
                };

                const resolveExplicitComponentId = (value, chain) => {
                    if (!value) {
                        return null;
                    }

                    const raw = value.trim();
                    if (!raw) {
                        return null;
                    }

                    const normalized = toKebabCase(raw);
                    const candidates = Array.from(new Set([
                        raw,
                        raw.toLowerCase(),
                        normalized,
                        normalized.endsWith('-component') ? normalized : `${normalized}-component`,
                    ]));

                    const matchesCandidate = (id) => candidates.some((candidate) =>
                        id === candidate || id.startsWith(`${candidate}_`)
                    );

                    for (const id of chain) {
                        if (matchesCandidate(id)) {
                            return id;
                        }
                    }

                    const allIds = Array.from(document.querySelectorAll('[data-impulse-id]'))
                        .map((node) => node.getAttribute('data-impulse-id'))
                        .filter(Boolean);

                    return allIds.find((id) => matchesCandidate(id)) || null;
                };

                const attemptAction = async (componentIds, action, options = {}) => {
                    if (!componentIds.length || !window.Impulse?.updateComponent) {
                        return;
                    }

                    for (let index = 0; index < componentIds.length; index += 1) {
                        const componentId = componentIds[index];

                        try {
                            return await window.Impulse.updateComponent(componentId, action, undefined, options);
                        } catch (error) {
                            const errorCode = error && (error.code || error?.data?.code) ? (error.code || error.data.code) : null;

                            if (errorCode === 'action_not_found' && index < componentIds.length - 1) {
                                continue;
                            }

                            throw error;
                        }
                    }
                };

                const performAction = (element, action) => {
                    const debounceDelay = parseInt(element.dataset.actionDebounce || '0', 10);
                    const throttleDelay = parseInt(element.dataset.actionThrottle || '0', 10);

                    const runAction = () => {
                        const lastRun = throttleMap.get(element) || 0;
                        const now = Date.now();

                        if (throttleDelay > 0 && now - lastRun < throttleDelay) {
                            return;
                        }

                        throttleMap.set(element, now);

                        const result = action();
                        if (result && typeof result.then === 'function') {
                            result.catch((error) => {
                                const errorCode = error && (error.code || error?.data?.code) ? (error.code || error.data.code) : null;
                                if (errorCode === 'action_not_found') {
                                    return;
                                }

                                console.error('Impulse action patch failed:', error);
                            });
                        }
                    };

                    if (debounceDelay > 0) {
                        clearTimeout(debounceMap.get(element));
                        const timer = setTimeout(runAction, debounceDelay);
                        debounceMap.set(element, timer);
                        return;
                    }

                    runAction();
                };

                document.addEventListener('click', (event) => {
                    const target = event.target;
                    if (!(target instanceof Element)) {
                        return;
                    }

                    const element = target.closest('[data-action-click]');
                    if (!element) {
                        return;
                    }

                    const method = element.getAttribute('data-action-click');
                    if (!method || !window.Impulse?.updateComponent) {
                        return;
                    }

                    const chain = getComponentChain(element);
                    if (chain.length === 0) {
                        return;
                    }

                    event.preventDefault();
                    event.stopPropagation();
                    event.stopImmediatePropagation();

                    const update = element.getAttribute('data-action-update') || undefined;
                    const explicitTarget = element.getAttribute('data-action-call');

                    performAction(element, () => {
                        if (explicitTarget) {
                            const componentId = resolveExplicitComponentId(explicitTarget, chain);
                            if (!componentId) {
                                throw new Error(`Component target not found for data-action-call="${explicitTarget}"`);
                            }

                            return attemptAction([componentId], method, { update });
                        }

                        return attemptAction(chain, method, { update });
                    });
                }, true);
            })();
        JS;
    }

    public function template(): string
    {
        return $this->view('layouts.default',  [
            'slot' => $this->slot()
        ]);
    }
}
