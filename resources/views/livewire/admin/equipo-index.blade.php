<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl"><i class="fas fa-clipboard"></i> Equipos</p>
    
    <div class="py-3 flex items-center">
        <x-jet-input class="flex-1" placeholder="Buscar..." type="text" wire:model="search" />
        
        <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        
        @can('admin.equipos.create')
        <a class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" wire:click="create" title="Crear Equipo">
            <i class="fas fa-plus-square"></i>
        </a>
        @endcan
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
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('fecha_compra')">
                        Fecha Compra
                        @if ($sort == 'fecha_compra')
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
                    @foreach ($equipos as $item)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $item->id }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $item->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $item->marca->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $item->modelo->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $item->categoria->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ date('d-m-Y', strtotime($item->fecha_compra));  }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm font-medium flex">
                            <a class="btn bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="descripcion({{ $item }})" title="Mas Detalles">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            @can('admin.equipos.edit')
                            <a class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="edit({{ $item }})" title="Editar Equipo">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            @can('admin.equipos.destroy')
                            <a class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="$emit('deleteUtil', {{ $item->id }}, 'equipo')" title="Eliminar Equipo">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
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
    
    <x-jet-dialog-modal wire:model="openEdit">
        <x-slot name="title">
                {{ $updateOrCreate == "update" ? "Editar" : "Crear"; }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input wire:model="equipo.nombre" type="text" class="w-full" />
                <x-jet-input-error for="equipo.nombre" />
            </div>
          
            <div class="mb-4">
                <x-jet-label value="Categoria" />
                    <select wire:model="categoriaSelected" class="form-control">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>                        
                        @endforeach 
                    </select>
                <x-jet-input-error for="categoriaSelected" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Marca" />
                <select wire:model="marcaSelected" class="form-control">
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>                        
                    @endforeach 
                </select>
                <x-jet-input-error for="marcaSelected" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Modelo" />
                <select wire:model="modeloSelected" class="form-control">
                    @if ($modelos)
                        @foreach ($modelos as $modelo)  
                            <option  value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>                        
                        @endforeach
                    @endif
                </select>
                <x-jet-input-error for="modeloSelected" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Fecha de Compra" />
                <input type="date" wire:model="fechaCompra" class="form-control">
                <x-jet-input-error for="fechaCompra" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Descripcion" />
                <textarea wire:model="equipo.descripcion" class="w-full" rows="6"></textarea>
                <x-jet-input-error for="equipo.descripcion" />
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
    
    <x-jet-dialog-modal wire:model="openDetails">
        <x-slot name="title">
            Detalles: <strong class="font-bold">{{ $equipo->nombre }}</strong>
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Descripcion" />
                <textarea wire:model="equipo.descripcion" class="w-full disabled:opacity-50" rows="6" disabled></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('openDetails', false)">
                Cerrar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>

