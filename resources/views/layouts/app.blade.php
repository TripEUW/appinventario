<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="turbolinks-cache-control" content="no-cache">
        {{-- <meta name="turbolinks-visit-control" content="reload"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" >

        @livewireStyles


    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ddslick.min.js') }}" defer></script>
    
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @if (Auth::user())
            @endif
            
            <!-- Page Content -->
            <main>
                <div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
                    @if (Auth::user())
                    @livewire('navigation')
                    @endif
                    {{ $slot }}
                </div>
            </main>
        </div>
    
    @stack('modals')
    
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    @stack('scripts')
    
    
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
