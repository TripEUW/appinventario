<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="turbolinks-cache-control" content="no-cache">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>" >

        <?php echo \Livewire\Livewire::styles(); ?>



    <!-- Scripts -->
    <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/ddslick.min.js')); ?>" defer></script>
    
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <?php if(Auth::user()): ?>
            <?php endif; ?>
            
            <!-- Page Content -->
            <main>
                <div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
                    <?php if(Auth::user()): ?>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation')->html();
} elseif ($_instance->childHasBeenRendered('40EVMSW')) {
    $componentId = $_instance->getRenderedChildComponentId('40EVMSW');
    $componentTag = $_instance->getRenderedChildComponentTagName('40EVMSW');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('40EVMSW');
} else {
    $response = \Livewire\Livewire::mount('navigation');
    $html = $response->html();
    $_instance->logRenderedChild('40EVMSW', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    <?php endif; ?>
                    <?php echo e($slot); ?>

                </div>
            </main>
        </div>
    
    <?php echo $__env->yieldPushContent('modals'); ?>
    
    <?php echo \Livewire\Livewire::scripts(); ?>

    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            Livewire.on('alert', function(icon, title)
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast'
                    }         
                })
                
                Toast.fire({
                    icon,
                    title
                });
            })
            
            Livewire.on('deleteUtil', (id,title) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let ruta = 'admin.' + title + '-index';
                        console.log(ruta)
                        Livewire.emitTo(ruta, 'delete', id);
                        Livewire.emit('alert', 'success', 'Eliminado con exito.');
                        
                    }
                })
            });
        });
    </script>
    
    </body>
</html>
<?php /**PATH D:\xampp\htdocs\appinventario\resources\views/layouts/app.blade.php ENDPATH**/ ?>