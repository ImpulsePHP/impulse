<?php

declare(strict_types=1);

namespace App\Component\Dashboard;

use Impulse\Core\Component\AbstractComponent;
use Impulse\Core\Component\Resolver\ComponentResolver;
use Impulse\UI\Component\Form\UISelectComponent;

final class VehicleFormDrawerComponent extends AbstractComponent
{
    public function setup(): void
    {
        $this->states([
            'open' => false,
            'drawerTitle' => 'Nouveau vehicule',
            'mode' => 'create',
            'formError' => '',
            'form' => [],
            'brandOptions' => [],
            'modelOptions' => [],
        ]);
    }

    public function template(): string
    {
        $open = (bool) $this->open;
        $drawerClasses = $open ? 'translate-x-0' : 'translate-x-full';
        $overlayClasses = $open ? 'opacity-100' : 'pointer-events-none opacity-0';
        $containerClasses = $open ? '' : 'pointer-events-none';
        $form = is_array($this->form) ? $this->form : [];
        $brandOptions = is_array($this->brandOptions) ? $this->brandOptions : [];
        $modelOptions = is_array($this->modelOptions) ? $this->modelOptions : [];
        $saveLabel = match ((string) $this->mode) {
            'edit' => 'Enregistrer les modifications',
            'data' => 'Mettre a jour le suivi',
            default => 'Ajouter le vehicule',
        };

        $errorAlert = (string) $this->formError !== '' ? <<<HTML
            <uialert
                title="Impossible d'enregistrer"
                description="{$this->escape((string) $this->formError)}"
                with-icon="true"
                icon-name="x-circle"
                color="rose"
                variant="filled"
            />
        HTML : '';

        $conditionOptions = $this->renderSelectOptions([
            'new' => 'Neuf',
            'used' => 'Occasion',
        ], (string) ($form['purchaseCondition'] ?? 'used'));
        $powertrainOptions = $this->renderSelectOptions([
            'electric' => 'Electrique',
            'phev' => 'Hybride rechargeable',
        ], (string) ($form['powertrain'] ?? 'electric'));
        $brandSelect = $this->renderSearchableSelect(
            name: 'brand',
            label: 'Marque',
            value: (string) ($form['brand'] ?? ''),
            options: $brandOptions,
            placeholder: 'Selectionner une marque',
            helpText: 'Catalogue pre-enregistre avec recherche integree.',
            disabled: false,
            iconName: 'truck',
        );
        $modelSelect = $this->renderSearchableSelect(
            name: 'model',
            label: 'Modele',
            value: (string) ($form['model'] ?? ''),
            options: $modelOptions,
            placeholder: $brandOptions !== [] && (string) ($form['brand'] ?? '') !== ''
                ? 'Selectionner un modele'
                : 'Choisis d abord une marque',
            helpText: (string) ($form['brand'] ?? '') !== ''
                ? 'Modeles filtres selon la marque selectionnee.'
                : 'Selectionne une marque pour charger les modeles.',
            disabled: (string) ($form['brand'] ?? '') === '',
            iconName: 'magnifying-glass',
        );
        $brandValue = $this->escape((string) ($form['brand'] ?? ''));
        $modelValue = $this->escape((string) ($form['model'] ?? ''));

        return <<<HTML
            <div class="fixed inset-0 z-50 {$containerClasses}">
                <button
                    type="button"
                    class="absolute inset-0 bg-slate-900/40 transition {$overlayClasses}"
                    data-action-call="vehicles-component"
                    data-action-click="closeDrawer"
                    aria-label="Fermer"
                ></button>

                <aside class="absolute right-0 top-0 bottom-0 w-[44rem] max-w-[100vw] border-l border-slate-200 bg-white shadow-xl transition-transform duration-300 {$drawerClasses}">
                    <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">{$this->escape((string) $this->drawerTitle)}</h3>
                            <p class="mt-1 text-sm text-slate-500">Creation, edition et suivi du vehicule.</p>
                        </div>
                        <button
                            type="button"
                            class="rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-600 transition hover:bg-slate-50"
                            data-action-call="vehicles-component"
                            data-action-click="closeDrawer"
                        >
                            Fermer
                        </button>
                    </div>

                    <div class="h-full overflow-y-auto p-5 pb-28">
                        <div class="space-y-6">
                            {$errorAlert}

                            <div class="rounded-2xl border border-slate-200 bg-slate-50/80 p-4">
                                <p class="text-sm font-medium text-slate-900">Informations generales</p>
                                <p class="mt-1 text-sm text-slate-500">
                                    Renseigne l'identite du vehicule, sa motorisation et les principales donnees de suivi.
                                </p>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="space-y-2">
                                    {$brandSelect}
                                    <input type="hidden" name="brand" value="{$brandValue}" />
                                </div>
                                <div class="space-y-2">
                                    {$modelSelect}
                                    <input type="hidden" name="model" value="{$modelValue}" />
                                </div>
                                <uiinput label="Version / finition" name="trim" value="{$this->escape((string) ($form['trim'] ?? ''))}" placeholder="Long Range, GT, Plus..." block="true" color="emerald" />
                                <uiinput label="Immatriculation" name="registration_plate" value="{$this->escape((string) ($form['registrationPlate'] ?? ''))}" placeholder="AB-123-CD" block="true" color="emerald" />
                                <uiinput label="Date d'acquisition" name="acquired_at" value="{$this->escape((string) ($form['acquiredAt'] ?? ''))}" type="date" block="true" color="emerald" />
                                <uiinput label="Année" name="year" value="{$this->escape((string) ($form['year'] ?? ''))}" type="number" placeholder="2025" block="true" color="emerald" />
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-slate-700">Etat a l'achat</label>
                                    <select name="purchase_condition" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-emerald-400 focus:outline-none focus:ring-1 focus:ring-emerald-400">
                                        {$conditionOptions}
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-slate-700">Motorisation</label>
                                    <select name="powertrain" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-emerald-400 focus:outline-none focus:ring-1 focus:ring-emerald-400">
                                        {$powertrainOptions}
                                    </select>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="mb-4">
                                    <p class="text-sm font-medium text-slate-900">Suivi technique</p>
                                    <p class="mt-1 text-sm text-slate-500">
                                        Ces donnees servent a suivre le kilometrage, l'efficacite energetique et les prochaines interventions.
                                    </p>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <uiinput label="Kilometrage actuel (km)" name="odometer_km" value="{$this->escape((string) ($form['odometerKm'] ?? ''))}" type="number" placeholder="24500" block="true" color="sky" />
                                    <uiinput label="Capacite batterie (kWh)" name="battery_capacity_kwh" value="{$this->escape((string) ($form['batteryCapacityKwh'] ?? ''))}" type="number" placeholder="77" block="true" color="sky" />
                                    <uiinput label="Consommation moyenne (kWh/100)" name="average_consumption_kwh" value="{$this->escape((string) ($form['averageConsumptionKwh'] ?? ''))}" type="number" placeholder="18.6" block="true" color="sky" />
                                    <uiinput label="Autonomie observee (km)" name="range_km" value="{$this->escape((string) ($form['rangeKm'] ?? ''))}" type="number" placeholder="410" block="true" color="sky" />
                                    <uiinput label="Prochain entretien" name="next_service_at" value="{$this->escape((string) ($form['nextServiceAt'] ?? ''))}" type="date" block="true" color="sky" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute inset-x-0 bottom-0 border-t border-slate-200 bg-white px-5 py-4">
                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                            <uibutton
                                type="button"
                                color="slate"
                                variant="outline"
                                label="Annuler"
                                data-action-call="vehicles-component"
                                data-action-click="closeDrawer"
                            />
                            <uibutton
                                type="button"
                                color="emerald"
                                variant="solid"
                                label="{$saveLabel}"
                                icon-name="check-badge"
                                icon-position="left"
                                data-action-call="vehicles-component"
                                data-action-click="saveVehicle"
                            />
                        </div>
                    </div>
                </aside>
            </div>
        HTML;
    }

    /**
     * @param list<array{value: string, label: string}> $options
     */
    private function renderSearchableSelect(
        string $name,
        string $label,
        string $value,
        array $options,
        string $placeholder,
        string $helpText,
        bool $disabled,
        string $iconName,
    ): string {
        $component = ComponentResolver::findByClass(UISelectComponent::class, [
            'name' => $name,
            'id' => 'vehicle-' . $name . '-select',
            'label' => $label,
            'value' => $value,
            'options' => $options,
            'placeholder' => $placeholder,
            'helpText' => $helpText,
            'block' => true,
            'color' => 'emerald',
            'searchable' => true,
            'searchPlaceholder' => 'Rechercher...',
            'disabled' => $disabled,
            'iconName' => $iconName,
            'iconPosition' => 'left',
        ]);

        return $component?->render() ?? '';
    }

    /**
     * @param array<string, string> $options
     */
    private function renderSelectOptions(array $options, string $selectedValue): string
    {
        $rendered = [];

        foreach ($options as $value => $label) {
            $selected = $selectedValue === $value ? 'selected' : '';
            $rendered[] = '<option value="' . $this->escape($value) . '" ' . $selected . '>' . $this->escape($label) . '</option>';
        }

        return implode('', $rendered);
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
