<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class BackupIndex extends Component
{

    public function render()
    {
        return view('livewire.admin.backup-index');
    }

    public function create()
    {
        Artisan::call('backup:run');
        $this->emit('alert', 'success', 'Creado con exito.');
        //dd(Artisan::output());
    }
}
