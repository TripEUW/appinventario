<x-app-layout>
		<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
			<p class="text-3xl"><i class="fas fa-house-user"></i> Home</p>
			<p class="mt-2">Bienvenido: <span class="font-bold">{{ auth()->user()->name }}</span></p>
		</div>
</x-app-layout>
