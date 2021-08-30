<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <p class="text-3xl"><i class="fab fa-buffer"></i> Categorias </p>
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

        <a class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold rounded" wire:click="create" title="Crear Categoria">
            <i class="fas fa-plus-square"></i>
        </a>
    </div>
    
    <?php if(count($categorias)): ?>
    <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" 
                        class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        wire:click="order('id')">
                        ID
                        <?php if($sort == 'id'): ?>
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
                        wire:click="order('nombre')">
                        Nombre
                        <?php if($sort == 'nombre'): ?>
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
                        class="relative px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                <?php echo e($item->id); ?>

                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <?php echo e($item->nombre); ?>

                        </td>
                        <td class="px-6 py-3 text-sm font-medium flex">
                            <a class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="edit(<?php echo e($item); ?>)" title="Editar Categoria">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if($item->equipos->isEmpty()): ?> 
                            <a class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" wire:click="$emit('deleteUtil', <?php echo e($item->id); ?>, 'categoria')" title="Eliminar Categoria">
                                <i class="fas fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
    </table>  
        <?php if($categorias->hasPages()): ?>
        <div class="px-6 py-3">
            <?php echo e($categorias->links()); ?>

        </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="px-6 py-3 bg-gray-50">
            No se encontro el registro...   
        </div>
    <?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['wire:model' => 'openEdit']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:model' => 'openEdit']); ?>
         <?php $__env->slot('title'); ?> 
                <?php echo e($updateOrCreate == "update" ? "Editar" : "Crear"); ?>

         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content'); ?> 
            
            <div class="mb-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['value' => 'Nombre']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => 'Nombre']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['wire:model' => 'categoria.nombre','type' => 'text','class' => 'w-full']]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:model' => 'categoria.nombre','type' => 'text','class' => 'w-full']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input-error','data' => ['for' => 'categoria.nombre']]); ?>
<?php $component->withName('jet-input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'categoria.nombre']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>
            
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer'); ?> 
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.secondary-button','data' => ['wire:click' => '$set(\'openEdit\', false)']]); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:click' => '$set(\'openEdit\', false)']); ?>
                Cancelar
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.danger-button','data' => ['wire:click' => ''.e($updateOrCreate).'','wire:loading.attr' => 'disabled','wire:target' => ''.e($updateOrCreate).'','class' => 'disabled:opacity-25']]); ?>
<?php $component->withName('jet-danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:click' => ''.e($updateOrCreate).'','wire:loading.attr' => 'disabled','wire:target' => ''.e($updateOrCreate).'','class' => 'disabled:opacity-25']); ?>
                <?php echo e($updateOrCreate == "update" ? "Actualizar" : "Crear"); ?>

             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>

     <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
</div>





<?php /**PATH D:\xampp\htdocs\appinventario\resources\views/livewire/admin/categoria-index.blade.php ENDPATH**/ ?>