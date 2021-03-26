<div>
    <x-filament::app-header :title="__($title)" />

    <x-filament::app-content>
        <x-filament::card>
            <form
                wire:submit.prevent="submit"
                class="space-y-6"
            >
                <x-forms::form :schema="$this->getForm()->getSchema()"/>
                <x-filament::button type="submit" color="primary" class="w-full">
                    {{ __(static::$saveButtonLabel) }}
                </x-filament::button>
            </form>
        </x-filament::card>
    </x-filament::app-content>
</div>
