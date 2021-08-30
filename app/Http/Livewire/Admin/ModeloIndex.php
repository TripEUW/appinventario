<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\Helper;
use App\Models\Marca;
use App\Models\Modelo;
use Livewire\Component;
use Livewire\WithPagination;


class ModeloIndex extends Component
{
    use WithPagination;

    public $modelo, $marcas, $updateOrCreate, $marcaSelected;
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

    public function mount()
    {
        $this->marcas = Marca::all();
    }

    public function rules()
    {
        return [
            'modelo.nombre' => 'required|unique:modelos,nombre,' .  optional($this->modelo)->id,
            'marcaSelected' => 'required'
        ];
    }

    public function render()
    {
        $modelos = Modelo::where('nombre', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.admin.modelo-index', compact('modelos'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }

    private function resetModelo()
    {
        $this->reset(['openEdit']);
        $this->marcaSelected = Marca::get()->first()->id;
    }

    public function edit(Modelo $modelo)
    {
        $this->openEdit = true;
        $this->updateOrCreate = "update";
        $this->modelo = $modelo;
        $this->marcaSelected = $modelo->marca->id;
        $this->validate();
    }

    public function update()
    {
        $this->validate();
        $data = Modelo::find($this->modelo->id);
        $data->update([
            'nombre' => $this->modelo->nombre,
            'marca_id' => $this->marcaSelected
        ]);
        $this->emit('alert', 'success', 'Editado con exito.');
        $this->resetModelo();
    }

    public function create(Modelo $modelo)
    {
        $this->resetModelo();
        $this->modelo = $modelo;
        $this->updateOrCreate = "save";
        $this->openEdit = true;
    }

    public function save()
    {
        $this->validate();
        Modelo::create([
            'nombre' => $this->modelo->nombre,
            'marca_id' => $this->marcaSelected
        ]);
        $this->emit('alert', 'success', 'Creado con exito.');
        $this->resetModelo();
    }

    public function delete(Modelo $modelo)
    {
        $modelo->delete();
        $this->resetPage();
    }
}
