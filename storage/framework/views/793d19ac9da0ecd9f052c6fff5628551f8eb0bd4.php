<div @click.away="open = false" class="flex flex-col w-full md:w-64 text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0" x-data="{ open: false }">
    <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
        <a href="<?php echo e(route('admin.home')); ?>" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Flowtrail UI</a>
        <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.home')): ?>
        <div @click.away="open = false" class="relative" x-data="{ open: false }">
            
            <button @click="open = !open" class="<?php echo e(request()->routeIs(['admin.home','profile.show', 'logout']) ? 'bg-gray-200' : 'bg-transparent'); ?> flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left rounded-lg md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    
                <span><i class="fas fa-user"></i> <?php echo e(auth()->user()->name); ?></span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                <div class="px-2 py-2 bg-white rounded-md shadow">
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.home')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.home') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.home')); ?>"><i class="fas fa-house-user"></i> Home</a>
                    <?php endif; ?>
                    <a class="<?php echo e(request()->routeIs('profile.show') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('profile.show')); ?>"><i class="fas fa-user-cog"></i> Your Profile</a>
         
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <a href="<?php echo e(route('logout')); ?>" class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" 
                            onclick="event.preventDefault();
                              this.closest('form').submit();">
                               <i class="fas fa-sign-out-alt"></i> Sign out
                            </a>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users.index')): ?>
        <div @click.away="open = false" class="relative" x-data="{ open: false }">
            
            <button @click="open = !open" class="<?php echo e(request()->routeIs(['admin.users.index','admin.roles.index']) ? 'bg-gray-200' : 'bg-transparent'); ?> flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left rounded-lg md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    
                <span><i class="fas fa-briefcase"></i> Admin</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                <div class="px-2 py-2 bg-white rounded-md shadow">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users.index')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.users.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.users.index')); ?>"><i class="fas fa-users"></i> Usuarios</a>
                    <?php endif; ?>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.roles.index')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.roles.index')? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.roles.index')); ?>"><i class="fas fa-key"></i> Roles</a>
                    <?php endif; ?>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.centrotrabajos.index')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.centrotrabajos.index')? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.centrotrabajos.index')); ?>"><i class="fas fa-building"></i> Centro Trabajo</a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.backup.index')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.backup.index')? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.backup.index')); ?>"><i class="fas fa-database"></i> Backup</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.equipos.index')): ?>
        <div @click.away="open = false" class="relative" x-data="{ open: false }">
            
            <button @click="open = !open" class="<?php echo e(request()->routeIs(['admin.equipos.index','admin.marcas.index','admin.modelos.index','admin.categories.index']) ? 'bg-gray-200' : 'bg-transparent'); ?> flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left rounded-lg md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    
                <span><i class="fas fa-chalkboard"></i> Equipos</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                <div class="px-2 py-2 bg-white rounded-md shadow">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.equipos.index')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.equipos.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.equipos.index')); ?>"><i class="fas fa-clipboard"></i> Lista</a>
                    <?php endif; ?>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.marcas.index')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.marcas.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.marcas.index')); ?>"><i class="fas fa-archive"></i> Marcas</a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.modelos.index')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.modelos.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.modelos.index')); ?>"><i class="fas fa-archive"></i> Modelos</a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.categories.index')): ?>
                    <a class="<?php echo e(request()->routeIs('admin.categories.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.categories.index')); ?>"><i class="fab fa-buffer"></i> Categorias</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <hr class="my-1">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.equiposcon.index')): ?>
        <a class="<?php echo e(request()->routeIs('admin.equiposcon.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.equiposcon.index')); ?>"><i class="fas fa-check-circle"></i> Asignados</a>
        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.equipossin.index')): ?>
        <a class="<?php echo e(request()->routeIs('admin.equipossin.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.equipossin.index')); ?>"><i class="fas fa-clock"></i> Por Asignar</a>
        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.equiposreportes.index')): ?>
        <a class="<?php echo e(request()->routeIs('admin.equiposreportes.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.equiposreportes.index')); ?>"><i class="fas fa-chart-line"></i> Reportes</a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.equiposdespachos.index')): ?>
        <a class="<?php echo e(request()->routeIs('admin.equiposdespachos.index') ? 'bg-gray-200' : 'bg-transparent'); ?> block px-4 py-2 mt-2 text-sm font-semibold rounded-lg  md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="<?php echo e(route('admin.equiposdespachos.index')); ?>"><i class="fas fa-biking"></i> Despachador</a>
        <?php endif; ?>
    </nav>
</div>


<?php /**PATH D:\xampp\htdocs\appinventario\resources\views/livewire/navigation.blade.php ENDPATH**/ ?>