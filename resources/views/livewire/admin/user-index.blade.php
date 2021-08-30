<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl"><i class="fas fa-users"></i> Usuarios</p>
    <div class="py-3 flex items-center">
        <x-jet-input class="flex-1" placeholder="Buscar..." type="text" wire:model="search" />

        <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <a class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold rounded mr-1" wire:click="create" title="Crear Usuario">
            <i class="fas fa-plus-square"></i>
        </a>
        <a class="btn bg-yellow-300 hover:bg-yellow-500 text-white font-bold rounded" wire:click="createUpload" title="Carga Masiva">
            <i class="fas fa-upload"></i>
        </a>
    </div>

    @if (count($users))
    <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" 
                        class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('id')">
                        ID
                        @if ($sort == 'id')
                            @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" 
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('name')">
                        Nombre
                        @if ($sort == 'name')
                            @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" 
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('email')">
                        Email
                        @if ($sort == 'email')
                            @if ($direction == 'asc')
                            <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" 
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Centro de Trabajo
                    </th>
                    <th scope="col" 
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rol
                    </th>
                    <th scope="col" 
                        class="relative px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $user->id }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            @if ($user->centrotrabajo == null)
                            vacio
                            @else
                            {{ $user->centrotrabajo->nombre }}
                  
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            @if ($user->roles->isEmpty())
                            <a class="btn btn-green" wire:click="edit({{ $user }})">Asignar rol</a>
                            @else
                            {{ $user->roles[0]->name }}
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm font-medium flex">
                            @if (!$user->roles->isEmpty())
                            <a class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2" title="Editar Usuario" wire:click="edit({{ $user }})">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif

                            @if ($user->id != auth()->id())
                            <a class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" title="Eliminar Usuario" wire:click="$emit('deleteUtil', {{ $user->id }}, 'user')">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>  
        @if ($users->hasPages())
        <div class="px-6 py-3">
            {{ $users->links() }}
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
                <x-jet-input wire:model="user.name" type="text" class="w-full" />
                <x-jet-input-error for="user.name" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Email" />
                <x-jet-input wire:model.defer="user.email" type="text" class="w-full" />
                <x-jet-input-error for="user.email" />
            </div>
            @if ($showDiv)
                <div class="mb-4">
                    <x-jet-label value="Password" />
                    <x-jet-input wire:model.defer="user.password" type="text" class="w-full" />
                    <x-jet-input-error for="user.password" />
                </div>
                
                <div class="mb-4">
                    <x-jet-label value="Confirm Password" />
                    <x-jet-input wire:model.defer="user.password_confirmation" type="text" class="w-full" />
                    <x-jet-input-error for="user.password_confirmation" />
                </div>
             @endif

            <div class="mb-4">
                <x-jet-label value="Rol" />
                <select wire:model="userRolSelected">
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>                        
                    @endforeach
                </select>
                <x-jet-input-error for="userRolSelected" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Centro Trabajo" />
                <select wire:model="centroTrabajoSelected" class="form-control">
                    @foreach ($centrotrabajos as $centro)
                        <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>                        
                    @endforeach
                </select>
                <x-jet-input-error for="centroTrabajoSelected" />
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
    
    <x-jet-dialog-modal wire:model="openUpload">
        <x-slot name="title">
            Carga Masiva
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <div wire:loading wire:target='file' class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Cargando...</strong>
                    <span class="block sm:inline">Espere un momento...</span>
                </div>
            </div>
            <div class="mb-4">
                <input type="file" wire:model="file" name="file" id="up{{ $iteration }}" enctype="multipart/form-data" >
                <x-jet-input-error for="file" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openUpload', false)">
                Cancelar
            </x-jet-secondary-button>
            
            <x-jet-danger-button wire:click="saveUpload" wire:loading.attr="disabled" wire:target="file" class="disabled:opacity-25">
                Subir
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
