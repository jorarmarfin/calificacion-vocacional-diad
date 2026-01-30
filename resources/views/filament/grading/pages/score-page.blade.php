<x-filament-panels::page>
    <div class="space-y-6 ">
        <!-- Formulario de Calificación -->
        <div>
            <form wire:submit="submit">
                {{ $this->form }}
                
                <div class="mt-4">
                    <x-filament::button type="submit">
                        Guardar Puntaje
                    </x-filament::button>
                </div>
            </form>
        </div>
        <!-- Tabla de pedidos -->
        <div class="overflow-x-auto">
            {{ $this->table }}
        </div>

    </div>
</x-filament-panels::page>
