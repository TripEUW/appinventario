<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\Helper;
use App\Models\Categoria;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use Livewire\Component;
use Livewire\WithPagination;


class EquipoIndex extends Component
{
	use WithPagination;

	public $marcaSelected = null, $modeloSelected = null, $categoriaSelected = null;
	public $equipo, $marcas, $modelos, $categorias, $updateOrCreate;
	public $search = '';
	public $sort = 'id';
	public $direction = 'desc';
	public $openEdit = false, $openDetails = false;
	public $fechaCompra;
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
		$this->categorias = Categoria::all();
		$this->equipo = new Equipo();
	}

	public function rules()
	{
		return [
			'equipo.nombre' => 'required|unique:equipos,nombre,' .  optional($this->equipo)->id,
			'equipo.descripcion' => 'required',
			'fechaCompra' => 'required',
			'marcaSelected' => 'required',
			'modeloSelected' => 'required',
			'categoriaSelected' => 'required'
		];
	}

	public function render()
	{
		$equipos = Equipo::where('nombre', 'LIKE', '%' . $this->search . '%')
			->orderBy($this->sort, $this->direction)
			->paginate($this->cant);

		return view('livewire.admin.equipo-index', compact('equipos'));
	}

	public function updatedmarcaSelected($marca_id)
	{
		$this->modelos = Modelo::where('marca_id', $marca_id)->get();
	}

	public function order($sort)
	{
		$orders = Helper::order($this->sort, $sort, $this->direction);
		$this->sort = $orders[0];
		$this->direction = $orders[1];
	}

	private function resetEquipo()
	{
		$this->reset(['openEdit', 'fechaCompra']);
		$this->marcaSelected = Marca::get()->first()->id;
		$this->modeloSelected = Modelo::get()->first()->id;
		$this->categoriaSelected = Categoria::get()->first()->id;
		$this->updatedmarcaSelected($this->marcaSelected);
	}

	public function descripcion(Equipo $equipo)
	{
		$this->openDetails = true;
		$this->equipo = $equipo;
	}

	public function edit(Equipo $equipo)
	{
		$this->openEdit = true;
		$this->updateOrCreate = "update";
		$this->equipo = $equipo;
		$this->updatedmarcaSelected($this->equipo->marca->id);
		$this->marcaSelected = $equipo->marca->id;
		$this->modeloSelected = $equipo->modelo->id;
		$this->categoriaSelected = $equipo->categoria->id;
		$this->fechaCompra = date('Y-m-d', strtotime($this->equipo->fecha_compra));
		$this->validate();
	}

	public function update()
	{
		$this->validate();
		$data = Equipo::find($this->equipo->id);
		$data->update([
			'nombre' => $this->equipo->nombre,
			'marca_id' => $this->marcaSelected,
			'modelo_id' => $this->modeloSelected,
			'categoria_id' => $this->categoriaSelected,
			'fecha_compra' => $this->fechaCompra,
			'descripcion' => $this->equipo->descripcion
		]);
		$this->emit('alert', 'success', 'Editado con exito.');
		$this->resetEquipo();
	}

	public function create(Equipo $equipo)
	{
		$this->resetEquipo();
		$this->equipo = $equipo;
		$this->updateOrCreate = "save";
		$this->openEdit = true;
		
	}

	public function save()
	{
		$this->validate();
		Equipo::create([
			'nombre' => $this->equipo->nombre,
			'marca_id' => $this->marcaSelected,
			'modelo_id' => $this->modeloSelected,
			'categoria_id' => $this->categoriaSelected,
			'fecha_compra' => $this->fechaCompra,
			'descripcion' => $this->equipo->descripcion

		]);
		$this->emit('alert', 'success', 'Creado con exito.');
		$this->resetEquipo();
	}

	public function delete(Equipo $equipo)
	{
		$equipo->delete();
		$this->resetPage();
	}
}
