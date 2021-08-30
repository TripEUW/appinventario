<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <p class="text-3xl mb-2"><i class="fas fa-chart-line"></i> Reportes</p>
    <div class="py-3 flex items-center">
        
        <select class="my-2 form-control" wire:model="search">
            <option value=""><?php echo e($text_list); ?></option>                        
            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>                        
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select wire:model="cant" class="mx-1.5 form-control" title="Mostrar">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        
    </div>

    <?php if(count($equipo_user)): ?>
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
                        wire:click="order('status')">
                        Estatus
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
                        wire:click="order('created_at')">
                        Fecha
                        <?php if($sort == 'created_at'): ?>
                        <?php if($direction == 'asc'): ?>
                        <i class="fas fa-sort-alpha-up-alt  mt-1"></i>
                        <?php else: ?>
                        <i class="fas fa-sort-alpha-down-alt  mt-1"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <i class="fas fa-sort  mt-1"></i>
                    <?php endif; ?>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $equipo_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php echo e($item->user->name); ?>

                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php echo e($item->equipo->categoria->nombre); ?>

                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php echo e($item->equipo->nombre); ?>

                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php echo e($equipo_status = ($item->status == 0) ? "Devuelto" : "Asignado"); ?> 
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php echo e(date('d-m-Y H:i:s', strtotime($item->created_at))); ?>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
    </table>  
        <?php if($equipo_user->hasPages()): ?>
        <div class="px-6 py-3">
            <?php echo e($equipo_user->links()); ?>

        </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="px-6 py-3 bg-gray-50">
            No se encontro el registro...
        </div>
    <?php endif; ?>
</div>
        <?php /**PATH D:\xampp\htdocs\appinventario\resources\views/livewire/admin/equipo-reporte.blade.php ENDPATH**/ ?>