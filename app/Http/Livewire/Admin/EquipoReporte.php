<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\Helper;
use App\Models\EquipoUser;
use Livewire\Component;
use Livewire\WithPagination;

class EquipoReporte extends Component
{
    use WithPagination;

    public $tipoUsuario, $text_list = "Todos los usuarios";
    public $usuarios = array();
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function mount()
    {
        $this->tipoUsuario = Helper::user_role();
    }

    public function render()
    {
        if ($this->tipoUsuario == 'Admin' || $this->tipoUsuario == 'Despachador') {

            foreach (EquipoUser::get()->unique('user_id') as $user) {
                $this->usuarios[$user->user->id] = $user->user->name;
            }

            // Todos
            if (is_null($this->search)) {
                $equipo_user = EquipoUser::get()
                    ->orderBy($this->sort, $this->direction)
                    ->latest('id')
                    ->paginate($this->cant);
            } else {
                $equipo_user = EquipoUser::where('user_id', 'LIKE', '%' . $this->search . '%')
                    ->orderBy($this->sort, $this->direction)
                    ->latest('id')
                    ->paginate($this->cant);
            }
        }

        if ($this->tipoUsuario == 'Usuario') {
            $this->text_list = auth()->user()->name;
            $equipo_user = EquipoUser::where('user_id', 'LIKE', '%' . auth()->user()->id . '%')
                ->orderBy($this->sort, $this->direction)
                ->latest('id')
                ->paginate($this->cant);
        }

        return view('livewire.admin.equipo-reporte', compact('equipo_user'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }
}
