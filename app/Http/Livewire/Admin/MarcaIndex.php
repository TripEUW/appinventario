<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\Helper;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;


class MarcaIndex extends Component
{
    use WithPagination;

    public $marca, $updateOrCreate;
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
        return [
            'marca.nombre' => 'required|unique:marcas,nombre,' .  optional($this->marca)->id,
        ];
    }

    public function render()
    {
        $marcas = Marca::where('nombre', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.admin.marca-index', compact('marcas'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }

    private function resetMarca()
    {
        $this->reset(['marca', 'openEdit']);
    }

    public function edit(Marca $marca)
    {
        $this->openEdit = true;
        $this->updateOrCreate = "update";
        $this->marca = $marca;
        $this->validate();
    }

    public function update()
    {
        $this->validate();
        $this->marca->update();
        $this->emit('alert', 'success', 'Editado con exito.');
        $this->resetMarca();
    }

    public function create()
    {
        $this->resetMarca();
        $this->updateOrCreate = "save";
        $this->openEdit = true;
    }

    public function save()
    {
        $this->validate();
        Marca::create($this->marca);
        $this->emit('alert', 'success', 'Creado con exito.');
        $this->resetMarca();
    }

    public function delete(Marca $marca)
    {
        $marca->delete();
        $this->resetPage();
    }
}
