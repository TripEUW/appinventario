<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl"><i class="fas fa-biking"></i> Despachador</p>
    <div class="py-3 flex items-center">
        
        <select class="my-2 form-control" wire:model="search">
            <option value="">Todos</option>                        
            <option value="1">Por Entregar</option>                        
            <option value="0">Por Recuperar</option>                        
        </select>
        
        <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>

    <?php if(count($equipos)): ?>
    <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" 
                        class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('status')">
                        Tipo
                        <?php if($sort == 'status'): ?>
                            <?php if($direction == 'asc'): ?>
                            <i class="fas fa-sort-alpha-up-alt  mt-1"></i>
                            <?php else: ?>
                            <i class="fas fa-sort-alpha-down-alt  mt-1"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <i class="fas fa-sort  mt-1"></i>
                        <?php endif; ?>
                    </th>
                    <th scope="col" 
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('equipo_id')">
                        Equipo
                        <?php if($sort == 'equipo_id'): ?>
                            <?php if($direction == 'asc'): ?>
                            <i class="fas fa-sort-alpha-up-alt  mt-1"></i>
                            <?php else: ?>
                            <i class="fas fa-sort-alpha-down-alt  mt-1"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <i class="fas fa-sort  mt-1"></i>
                        <?php endif; ?>
                    </th>
                    <th scope="col" 
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('user_id')">
                        Usuario
                        <?php if($sort == 'user_id'): ?>
                            <?php if($direction == 'asc'): ?>
                            <i class="fas fa-sort-alpha-up-alt  mt-1"></i>
                            <?php else: ?>
                            <i class="fas fa-sort-alpha-down-alt  mt-1"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <i class="fas fa-sort  mt-1"></i>
                        <?php endif; ?>
                    </th>
                    <th scope="col" 
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                    </th>
                    <th scope="col">

                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php if($equipo->status): ?>
                                <strong class="font-bold"><?php echo e("Entrega"); ?></strong>
                                <?php else: ?>
                                <strong class="font-bold"><?php echo e("Recuperación"); ?></strong>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php echo e($equipo->equipo->nombre); ?>

                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php echo e($equipo->user->name); ?>

                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                                <div class="text-sm text-gray-900">
                                    <?php
                                    $arg_fecha = '';
                                    $arg_fecha_user = '';
                                    if($equipo->status)
                                    {
                                        if($equipo->status_req){
                                            $arg_req = "Despachado al usuario";
                                            $arq_req_color = "text-green-500";
                                            $arg_fecha = date('d-m-Y H:i:s', strtotime($equipo->fecha_status_req));
                                        }else{
                                            $arg_req = "Pendiente por despachar";
                                            $arq_req_color = "text-red-500";
                                           
                                        }
                                        
                                        if($equipo->status_req_user){
                                            $arg_req_user = "Equipo recibido";
                                            $arq_req_user_color = "text-green-500";
                                            $arg_fecha_user = date('d-m-Y H:i:s', strtotime($equipo->fecha_status_req_user));
                                        }else{
                                            $arg_req_user = "Pendiente por recepción";
                                            $arq_req_user_color = "text-red-500";
                                        }
                                    }else{
                                        if($equipo->status_req){
                                            $arg_req = "Equipo recuperado";
                                            $arq_req_color = "text-green-500";
                                            $arg_fecha = $equipo->fecha_status_req;
                                        }else{
                                            $arg_req = "Confirmar recuperación";
                                            $arq_req_color = "text-red-500";
                                            
                                        }
                                        
                                        if($equipo->status_req_user){
                                            $arg_req_user = "Equipo devuelto";
                                            $arq_req_user_color = "text-green-500";
                                            $arg_fecha_user = $equipo->fecha_status_req_user;
                                        }else{
                                            $arg_req_user = "Pendiente por devolver";
                                            $arq_req_user_color = "text-red-500";
                                            
                                        }
                                    }
                                    ?>
                                    <ul>
                                        <li class="text-sm font-bold">Despachador: <span class="<?php echo e($arq_req_color); ?>"><?php echo e($arg_req); ?></span>&nbsp;<span><?php echo e($arg_fecha); ?></span></li>
                                        <li class="text-sm font-bold">Usuario: <span class="<?php echo e($arq_req_user_color); ?>"><?php echo e($arg_req_user); ?></span>&nbsp;<span><?php echo e($arg_fecha_user); ?></span></li>
                                    </ul>
                                </div>
                            </td>
                        <td class="px-6 py-3 text-sm font-medium flex">
                            <?php
                                $showBtn = true;
                                if($equipo->status){
                                    $title = "Despachar";
                                    $icon = "fas fa-clipboard-check";
                                    $flag = 1;
                                }else{
                                    $title = "Recuperar";
                                    $icon = "fas fa-undo";
                                    $flag = 2;
                                }
                                if($equipo->status_req && $equipo->status_req_user){
                                    $showBtn = false;
                                }elseif($equipo->status_req && !$equipo->status_req_user){
                                    $showBtn = false;
                                }
                            ?>
                            <?php if($showBtn): ?>

                             <a class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" wire:click="create(<?php echo e($equipo); ?>, '<?php echo e($flag); ?>')" title="<?php echo e($title); ?>">
                                <i class="<?php echo e($icon); ?>"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
    </table>  
    
        <?php if($equipos->hasPages()): ?>
        <div class="px-6 py-3">
            <?php echo e($equipos->links()); ?>

        </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="px-6 py-3 bg-gray-50">
            No se encontro el registro...
        </div>
    <?php endif; ?>


</th>
</div>
<?php /**PATH D:\xampp\htdocs\appinventario\resources\views/livewire/admin/equipo-despacho-index.blade.php ENDPATH**/ ?>