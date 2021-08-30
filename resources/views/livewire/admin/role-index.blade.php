<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl"><i class="fas fa-key"></i> Roles</p>
    <div class="py-3 flex items-center">
        <x-jet-input class="flex-1" placeholder="Buscar..." type="text" wire:model="search" />

        <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <a class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold rounded mr-1" wire:click="create" title="Crear Rol">
            <i class="fas fa-plus-square"></i>
        </a>
    </div>

    @if (count($roles))
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
                        wire:click="order('name')">
                        Nombre
                        @if ($sort == 'name')
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
                @foreach ($roles as $rol)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $rol->id }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            {{ $rol->name }}
                        </td>
                        <td class="px-6 py-3 text-sm font-medium flex">
                            <a class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="edit({{ $rol }})">
                                <i class="fas fa-edit"></i>
                            </a>

                            @if ($rol->users->isEmpty()) 
                            <a class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" title="Borrar" wire:click="$emit('deleteUtil', {{ $rol->id }}, 'role')">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endif
                        </td>
                    </tr>   
                @endforeach
            </tbody>
    </table>  
        @if ($roles->hasPages())
        <div class="px-6 py-3">
            {{ $roles->links() }}
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
                <x-jet-input wire:model.defer="rol.name" type="text" class="w-full" />
                <x-jet-input-error for="rol.name" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Permisos" />
                <select multiple wire:model.defer="rolPermisoSelected"">
                    @foreach ($permissions as $permiso)
                        <option value="{{ $permiso->id }}">{{ $permiso->description }}</option>                        
                    @endforeach
                </select>
                <x-jet-input-error for="rolPermisoSelected" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openEdit', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="{{ $updateOrCreate }}" wire:loading.attr="disabled" class="disabled:opacity-25">
                {{ $updateOrCreate == "update" ? "Actualizar" : "Crear"; }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
    