<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl"><i class="fas fa-building"></i> Centros de Trabajo </p>
<div class="py-3 flex items-center">
    <x-jet-input class="flex-1" placeholder="Buscar..." type="text" wire:model="search" />
    
    <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>

    @can('admin.centrotrabajos.create')
    <a class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" wire:click="create" title="Crear Categoria">
        <i class="fas fa-plus-square"></i>
    </a>
    @endcan
</div>

@if (count($centrotrabajos))
<table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" 
                    class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    wire:click="order('id')">
                    ID
                    @if ($sort == 'id')
                        @if ($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt  mt-1"></i>
                        @else
                        <i class="fas fa-sort-alpha-down-alt  mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort  mt-1"></i>
                    @endif
                </th>
                <th scope="col" 
                    class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    wire:click="order('nombre')">
                    Nombre
                    @if ($sort == 'nombre')
                        @if ($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt  mt-1"></i>
                        @else
                        <i class="fas fa-sort-alpha-down-alt  mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort  mt-1"></i>
                    @endif
                </th>
                <th scope="col" 
                    class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    wire:click="order('direccion')">
                    Direccion
                    @if ($sort == 'direccion')
                        @if ($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt  mt-1"></i>
                        @else
                        <i class="fas fa-sort-alpha-down-alt  mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort  mt-1"></i>
                    @endif
                </th>
                <th scope="col" 
                    class="relative px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($centrotrabajos as $item)
                <tr>
                    <td class="px-6 py-3 text-sm text-gray-500">
                        <div class="text-sm text-gray-900">
                            {{ $item->id }}
                        </div>
                    </td>
                    <td class="px-6 py-3 text-sm text-gray-500">
                        {{ $item->nombre }}
                    </td>
                    <td class="px-6 py-3 text-sm text-gray-500">
                        {{ $item->direccion }}
                    </td>
                    <td class="px-6 py-3 text-sm font-medium flex">
                        <a class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="edit({{ $item }})" title="Editar Centro">
                            <i class="fas fa-edit"></i>
                        </a>
                        {{-- @if ($item->equipos->isEmpty())  --}}
                        <a class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="$emit('deleteUtil', {{ $item->id }}, 'centro-trabajo')" title="Eliminar Centro">
                            <i class="fas fa-trash"></i>
                        </a>
                        {{-- @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>  
    @if ($centrotrabajos->hasPages())
    <div class="px-6 py-3">
        {{ $centrotrabajos->links() }}
    </div>
    @endif
@else
    <div class="px-6 py-3 bg-gray-50">
        No se encontro el registro...   
    </div>
@endif

<x-jet-dialog-modal wire:model="openEdit">
    <x-slot name="title">
            {{ $updateOrCreate == "update" ? "Editar" : "Crear"; }}
    </x-slot>

    <x-slot name="content">
        
        <div class="mb-4">
            <x-jet-label value="Nombre" />
            <x-jet-input wire:model="centrotrabajo.nombre" type="text" class="w-full" />
            <x-jet-input-error for="centrotrabajo.nombre" />
        </div>
        <div class="mb-4">
            <x-jet-label value="Direccion" />
            <textarea wire:model="centrotrabajo.direccion" class="w-full" rows="6"></textarea>
            <x-jet-input-error for="centrotrabajo.direccion" />
        </div>
        
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('openEdit', false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="{{ $updateOrCreate }}" wire:loading.attr="disabled" wire:target="{{ $updateOrCreate }}" class="disabled:opacity-25">
            {{ $updateOrCreate == "update" ? "Actualizar" : "Crear"; }}
        </x-jet-danger-button>
    </x-slot>

</x-jet-dialog-modal>
</div>





