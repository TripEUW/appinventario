<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\Helper;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class RoleIndex extends Component
{
    use WithPagination;

    public $rol, $permissions, $updateOrCreate;
    public $search = '';
    public $sort = 'id', $direction = 'desc';
    public $openEdit = false;
    public $rolPermisoSelected = array();
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
            'rol.name' => 'required|unique:roles,name,' .  optional($this->rol)->id,
            'rolPermisoSelected' => 'required',
        ];
    }

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    public function render()
    {
        $roles = Role::where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.admin.role-index', compact('roles'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }

    public function edit(Role $rol)
    {
        $this->updateOrCreate = "update";
        $this->rolPermisoSelected = null;
        $this->rol = $rol;
        foreach ($rol->permissions as $item) {
            $this->rolPermisoSelected[] = $item->id;
        }
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();
        $this->rol->update();
        $this->rol->permissions()->sync($this->rolPermisoSelected);
        $this->reset(['openEdit']);
        $this->rol = null;
        $this->emit('alert', 'success', 'Editado con exito.');
    }

    public function create()
    {
        $this->updateOrCreate = "save";
        $this->rolPermisoSelected = null;
        $this->openEdit = true;
    }

    public function save()
    {
        $this->validate();
        $rol = Role::create($this->rol);
        $rol->permissions()->sync($this->rolPermisoSelected);
        $this->reset(['openEdit']);
        $this->rol = null;
        $this->emit('alert', 'success', 'Creado con exito.');
    }

    public function delete(Role $rol)
    {
        $rol->delete();
        $this->resetPage();
    }
}
