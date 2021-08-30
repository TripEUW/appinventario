<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
		<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
			<p class="text-3xl"><i class="fas fa-house-user"></i> Home</p>
			<p class="mt-2">Bienvenido: <span class="font-bold"><?php echo e(auth()->user()->name); ?></span></p>
		</div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\appinventario\resources\views/admin/index.blade.php ENDPATH**/ ?>