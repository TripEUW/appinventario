<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl"><i class="fas fa-clock"></i> Equipos por Asignar</p>
    <div class="py-3 flex items-center">
        <x-jet-input class="flex-1" placeholder="Buscar..." type="text" wire:model="search" />
        
        <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    @if (count($equipos))
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
                        wire:click="order('marca_id')">
                        Marca
                        @if ($sort == 'marca_id')
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
                        wire:click="order('modelo_id')">
                        Modelo
                        @if ($sort == 'modelo_id')
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
                        wire:click="order('categoria_id')">
                        Categoria
                        @if ($sort == 'categoria_id')
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
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Asignar
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($equipos as $equipo)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $equipo->id }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $equipo->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $equipo->marca->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $equipo->modelo->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $equipo->categoria->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm font-medium flex">
                            <a class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="create({{ $equipo }})" title="Asignar Equipo">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>  
        @if ($equipos->hasPages())
        <div class="px-6 py-3">
            {{ $equipos->links() }}
        </div>
        @endif
    @else
        <div class="px-6 py-3 bg-gray-50">
            No se encontro el registro...
        </div>
    @endif

    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Asignar
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="User" />
                <select wire:model="userSelected">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>                        
                    @endforeach
                </select>
                <x-jet-input-error for="userSelected" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                Asignar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
    