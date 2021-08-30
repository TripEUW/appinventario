<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\Helper;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;


class CategoriaIndex extends Component
{

    use WithPagination;

    public $categoria, $updateOrCreate;
    public $search = '', $roles;
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
            'categoria.nombre' => 'required|unique:categorias,nombre,' .  optional($this->categoria)->id
        ];

        return $validations;
    }

    public function render()
    {
        $categorias = Categoria::where('nombre', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.admin.categoria-index', compact('categorias'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }

    private function resetCategoria()
    {
        $this->reset(['categoria', 'openEdit']);
    }

    public function edit(Categoria $categoria)
    {
        $this->resetCategoria();
        $this->updateOrCreate = "update";
        $this->categoria = $categoria;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();
        $this->categoria->update();
        $this->emit('alert', 'success', 'Editado con exito.');
        $this->reset(['openEdit']);
    }

    public function create()
    {
        $this->resetCategoria();
        $this->updateOrCreate = "save";
        $this->openEdit = true;
    }

    public function save()
    {
        $this->validate();

        Categoria::create([
            'nombre' => $this->categoria['nombre']

        ]);
        $this->emit('alert', 'success', 'Creado con exito.');
        $this->reset(['openEdit']);
    }

    public function delete(Categoria $categoria)
    {

        $categoria->delete();
        $this->resetPage();
    }
}
