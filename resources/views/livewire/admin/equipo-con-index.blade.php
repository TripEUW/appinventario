<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl mb-2"><i class="fas fa-check-circle"></i> Equipos Asignados</p>


    @can('admin.users.index')
        @if (!$flagVacio)
            <div class="py-3 flex items-center">
                <x-jet-input class="flex-1" placeholder="Buscar..." type="text" wire:model="search" />

                <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                
            </div>
        @endif
    @endcan

    @if (count($equipos))

    <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" 
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('equipos.id')">
                        Nombre
                        @if ($sort == 'equipos.id')
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
                        wire:click="order('equipos.user_id')">
                        Usuario
                        @if ($sort == 'equipos.user_id')
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
                        Status
                    </th>
                    @can('admin.equiposcon.create')
                    <th scope="col">
                    </th>
                    @endcan
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($equipos as $equipo)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <strong>{{ $equipo->nombre }}</strong>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <strong>{{ $equipo->name }}</strong>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                @php
                                    if($equipo->status_req){
                                        $arg_req = "Despachado al usuario";
                                        $arq_req_color = "text-green-500";
                                    }else{
                                        $arg_req = "Pendiente por despachar";
                                        $arq_req_color = "text-red-500";
                                    }

                                    if($equipo->status_req_user){
                                        $arg_req_user = "Equipo recibido";
                                        $arq_req_user_color = "text-green-500";
                                    }else{
                                        $arg_req_user = "Pendiente por recepción";
                                        $arq_req_user_color = "text-red-500";
                                    }
                                @endphp
                                <ul>
                                    <li class="text-sm font-bold">Despachador: <span class="{{ $arq_req_color }}">{{ $arg_req }}</span></li>
                                    <li class="text-sm font-bold">Usuario: <span class="{{ $arq_req_user_color }}">{{ $arg_req_user }}</span></li>
                                </ul>
                            </div>
                        </td>
                        @can('admin.equiposcon.create')
                        <td class="px-6 py-3 text-sm font-medium flex">
                            @php
                                $showBtn = true;
                                if($equipo->status_req && $equipo->status_req_user)
                                {
                                    $title = "Devolver Equipo";
                                    $icon = "fas fa-undo";
                                    $text_color = "bg-red-500 hover:bg-red-700";
                                    $flag = 1;
                                    
                                }elseif($equipo->status_req && !$equipo->status_req_user){
                                    $title = "Equipo Recibido";
                                    $icon = "fas fa-clipboard-check";
                                    $text_color = "bg-green-500 hover:bg-green-700";
                                    $flag = 2;

                                }else{
                                    $showBtn = false;
                                }
                            @endphp
                            @if ($showBtn)
                            <a class="btn {{ $text_color }} text-white font-bold py-2 px-4 rounded ml-2" wire:click="create({{ $equipo->id }}, '{{ $flag }}')" title="{{ $title }}">
                                <i class="{{ $icon }}"></i>
                            </a>
                            @endif
                        </td>
                        @endcan
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
        @if ($flagVacio)
        <div class="px-6 py-3 bg-gray-50 mt-2">
            No hay asignados aun... 
            @can('admin.users.index')
                <a class="btn btn-green" href="{{ route('admin.equipossin.index') }}">Asignar</a>
            @endcan
        </div>
    @else
        <div class="px-6 py-3 bg-gray-50">
            No se encontro el registro...
        </div>
        @endif
    @endif
</div>
