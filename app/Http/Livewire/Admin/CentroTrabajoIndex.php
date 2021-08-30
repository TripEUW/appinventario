<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\Helper;
use App\Models\CentroTrabajo;
use Livewire\Component;
use Livewire\WithPagination;


class CentroTrabajoIndex extends Component
{

    use WithPagination;

    public $centrotrabajo, $updateOrCreate;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $openEdit = false;
    public $cant = '10';

    protected $listeners = ['delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function rules()
    {
        $validations = [
            'centrotrabajo.nombre' => 'required|unique:centro_trabajos,nombre,' .  optional($this->centrotrabajo)->id,
            'centrotrabajo.direccion' => 'required',
        ];

        return $validations;
    }

    public function render()
    {
        $centrotrabajos = CentroTrabajo::where('nombre', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.admin.centro-trabajo-index', compact('centrotrabajos'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }

    private function resetCentroTrabajo()
    {
        $this->reset(['centrotrabajo', 'openEdit']);
    }

    public function edit(CentroTrabajo $centrotrabajo)
    {
        $this->resetCentroTrabajo();
        $this->updateOrCreate = "update";
        $this->centrotrabajo = $centrotrabajo;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();
        $this->centrotrabajo->update();
        $this->emit('alert', 'success', 'Editado con exito.');
        $this->resetCentroTrabajo();
        //$this->reset(['openEdit']);
    }

    public function create()
    {
        $this->resetCentroTrabajo();
        $this->updateOrCreate = "save";
        $this->openEdit = true;
    }

    public function save()
    {
        $this->validate();

        CentroTrabajo::create([
            'nombre' => $this->centrotrabajo['nombre'],
            'direccion' => $this->centrotrabajo['direccion']

        ]);
        $this->emit('alert', 'success', 'Creado con exito.');
        //$this->reset(['openEdit']);
        $this->resetCentroTrabajo();
    }

    public function delete(CentroTrabajo $centrotrabajo)
    {

        $centrotrabajo->delete();
        $this->resetPage();
    }
}
