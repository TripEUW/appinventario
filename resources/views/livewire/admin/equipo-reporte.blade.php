<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl mb-2"><i class="fas fa-chart-line"></i> Reportes</p>
    <div class="py-3 flex items-center">
        
        <select class="my-2 form-control" wire:model="search">
            <option value="">{{ $text_list }}</option>                        
            @foreach ($usuarios as $key => $value)
            <option value="{{ $key}}">{{ $value }}</option>                        
            @endforeach
        </select>

        <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        
    </div>

    @if (count($equipo_user))
    <table class="w-full divide-y divide-gray-200 mt-2">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" 
                        class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Usuario
                    </th>
                    <th scope="col" 
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoria
                    </th>
                    <th scope="col" 
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('equipo_id')">
                        Equipo
                        @if ($sort == 'equipo_id')
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
                        wire:click="order('status')">
                        Estatus
                        @if ($sort == 'status')
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
                        wire:click="order('created_at')">
                        Fecha
                        @if ($sort == 'created_at')
                        @if ($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt  mt-1"></i>
                        @else
                        <i class="fas fa-sort-alpha-down-alt  mt-1"></i>
                        @endif
                    @else
                        <i class="fas fa-sort  mt-1"></i>
                    @endif
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($equipo_user as $item)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $item->user->name }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $item->equipo->categoria->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $item->equipo->nombre }}
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $equipo_status = ($item->status == 0) ? "Devuelto" : "Asignado"; }} 
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ date('d-m-Y H:i:s', strtotime($item->created_at));  }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>  
        @if ($equipo_user->hasPages())
        <div class="px-6 py-3">
            {{ $equipo_user->links() }}
        </div>
        @endif
    @else
        <div class="px-6 py-3 bg-gray-50">
            No se encontro el registro...
        </div>
    @endif
</div>
        