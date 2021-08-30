<?php

use App\Http\Livewire\Admin\BackupIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\CategoriaIndex;
use App\Http\Livewire\Admin\CentroTrabajoIndex;
use App\Http\Livewire\Admin\EquipoIndex;
use App\Http\Livewire\Admin\EquipoReporte;
use App\Http\Livewire\Admin\EquipoSinIndex;
use App\Http\Livewire\Admin\MarcaIndex;
use App\Http\Livewire\Admin\ModeloIndex;
use App\Http\Livewire\Admin\UserIndex;
use App\Http\Livewire\Admin\RoleIndex;
use App\Http\Livewire\Admin\EquipoConIndex;
use App\Http\Livewire\Admin\EquipoDespachoIndex;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('admin.index');
})->name('admin.home');

Route::middleware(['middleware' => 'can:admin.users.index'])
->get('/users', UserIndex::class)->name('admin.users.index');

Route::middleware(['middleware' => 'can:admin.roles.index'])
->get('/roles', RoleIndex::class)->name('admin.roles.index');

Route::middleware(['middleware' => 'can:admin.centrotrabajos.index'])
->get('/centrotrabajos', CentroTrabajoIndex::class)->name('admin.centrotrabajos.index');

Route::middleware(['middleware' => 'can:admin.backup.index'])
->get('/backup', BackupIndex::class)->name('admin.backup.index');

Route::middleware(['middleware' => 'can:admin.categories.index'])
->get('/categories', CategoriaIndex::class)->name('admin.categories.index');

Route::middleware(['middleware' => 'can:admin.marcas.index'])
->get('/marcas', MarcaIndex::class)->name('admin.marcas.index');

Route::middleware(['middleware' => 'can:admin.modelos.index'])
->get('/modelos', ModeloIndex::class)->name('admin.modelos.index');

Route::middleware(['middleware' => 'can:admin.equipos.index'])
->get('/equipos', EquipoIndex::class)->name('admin.equipos.index');

Route::middleware(['middleware' => 'can:admin.equipossin.index'])
->get('/equipossin', EquipoSinIndex::class)->name('admin.equipossin.index');

Route::middleware(['middleware' => 'can:admin.equiposcon.index'])
->get('/equiposcon', EquipoConIndex::class)->name('admin.equiposcon.index');

Route::middleware(['middleware' => 'can:admin.equiposreportes.index'])
->get('/equiposreportes', EquipoReporte::class)->name('admin.equiposreportes.index');

Route::middleware(['middleware' => 'can:admin.equiposdespachos.index'])
->get('/equiposdespachos', EquipoDespachoIndex::class)->name('admin.equiposdespachos.index');
