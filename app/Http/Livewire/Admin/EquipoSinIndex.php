<?php

namespace App\Http\Livewire\Admin;

use App\Events\EquipoValidarEvent;
use App\Helpers\Helper;
use App\Models\Equipo;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class EquipoSinIndex extends Component
{
    use WithPagination;

    public $categoria_id, $equipo_id, $users, $tipo_usuario;
    public $equipo = null;
    public $userSelected = null;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $open_edit = false;
    public $arg;
    public $cant = '10';

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount()
    {
        $this->users = User::all();
    }

    protected $rules = [
        'userSelected' => 'required'
    ];

    public function render()
    {
        $equipos = Equipo::where('nombre', 'LIKE', '%' . $this->search . '%')
            ->where('status', false)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.admin.equipo-sin-index', compact('equipos'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }

    public function create(Equipo $equipo)
    {
        $this->equipo = $equipo;
        $this->equipo_id = $this->equipo->id;
        $this->categoria_id = $this->equipo->categoria_id;
        $this->open_edit = true;
        $this->userSelected = User::get()->first()->id;
    }

    public function save()
    {
        $this->validate();

        Equipo::where('id', $this->equipo_id)->update(['status' => true]);

        $res = event(new EquipoValidarEvent($this->equipo_id, $this->userSelected, 1, 0, 0, 0));

        if ($res) {
            $this->emit('alert', 'success', 'Pendiente por asignar.');
        }

        $this->reset(['open_edit']);
    }
}
