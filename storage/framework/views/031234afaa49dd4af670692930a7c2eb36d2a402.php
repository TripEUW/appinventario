<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl mb-2"><i class="fas fa-check-circle"></i> Equipos Asignados</p>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users.index')): ?>
        <?php if(!$flagVacio): ?>
            <div class="py-3 flex items-center">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['class' => 'flex-1','placeholder' => 'Buscar...','type' => 'text','wire:model' => 'search']]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'flex-1','placeholder' => 'Buscar...','type' => 'text','wire:model' => 'search']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(count($equipos)): ?>

    <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" 
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('equipos.id')">
                        Nombre
                        <?php if($sort == 'equipos.id'): ?>
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
                        wire:click="order('equipos.user_id')">
                        Usuario
                        <?php if($sort == 'equipos.user_id'): ?>
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
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.equiposcon.create')): ?>
                    <th scope="col">
                    </th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <strong><?php echo e($equipo->nombre); ?></strong>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <strong><?php echo e($equipo->name); ?></strong>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php
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
                                ?>
                                <ul>
                                    <li class="text-sm font-bold">Despachador: <span class="<?php echo e($arq_req_color); ?>"><?php echo e($arg_req); ?></span></li>
                                    <li class="text-sm font-bold">Usuario: <span class="<?php echo e($arq_req_user_color); ?>"><?php echo e($arg_req_user); ?></span></li>
                                </ul>
                            </div>
                        </td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.equiposcon.create')): ?>
                        <td class="px-6 py-3 text-sm font-medium flex">
                            <?php
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
                            ?>
                            <?php if($showBtn): ?>
                            <a class="btn <?php echo e($text_color); ?> text-white font-bold py-2 px-4 rounded ml-2" wire:click="create(<?php echo e($equipo->id); ?>, '<?php echo e($flag); ?>')" title="<?php echo e($title); ?>">
                                <i class="<?php echo e($icon); ?>"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                        <?php endif; ?>
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
        <?php if($flagVacio): ?>
        <div class="px-6 py-3 bg-gray-50 mt-2">
            No hay asignados aun... 
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users.index')): ?>
                <a class="btn btn-green" href="<?php echo e(route('admin.equipossin.index')); ?>">Asignar</a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="px-6 py-3 bg-gray-50">
            No se encontro el registro...
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH D:\xampp\htdocs\appinventario\resources\views/livewire/admin/equipo-con-index.blade.php ENDPATH**/ ?>