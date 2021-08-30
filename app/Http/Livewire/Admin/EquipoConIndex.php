<?php

namespace App\Http\Livewire\Admin;

use App\Events\EquipoValidarEvent;
use App\Helpers\Helper;
use App\Models\EquipoUser;
use App\Models\EquipoUserReq;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EquipoConIndex extends Component
{
    use WithPagination;

    public $equipo, $arg1, $tipoUsuario;
    public $flagVacio = false;
    public $search = '';
    public $sort = 'equipos.id';
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

        if ($this->tipoUsuario == 'Usuario' || $this->tipoUsuario == 'Despachador') {

            $this->arg1 = auth()->user()->id;
        }

        $equipos = DB::table('equipo_user_reqs')
            ->join('equipos', 'equipos.id', '=', 'equipo_user_reqs.equipo_id')
            ->join('users', 'users.id', '=', 'equipo_user_reqs.user_id')
            ->where('equipo_user_reqs.user_id', 'LIKE', '%' . $this->arg1 . '%')
            ->where('equipo_user_reqs.status', true)
            ->where(function ($equipos) {
                $equipos->where('equipos.nombre', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $this->search . '%');
            })
            ->select('equipos.nombre', 'users.name', 'equipo_user_reqs.*')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        if ($equipos->isEmpty() && empty($this->search)) {
            $this->flagVacio = true;
        }

        return view('livewire.admin.equipo-con-index', compact('equipos'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }

    public function create(EquipoUserReq $equipo, $flag)
    {
        $this->equipo = $equipo;

        // Equipo recibido
        if ($flag == 2) {
            $res = event(new EquipoValidarEvent($this->equipo->equipo_id, $this->equipo->user_id, 1, 1, 1, 2));

            if ($res) {
                $this->emit('alert', 'success', 'Equipo Recibido.');
                EquipoUser::create([
                    'status' => 1,
                    'user_id' => $this->equipo->user_id,
                    'equipo_id' => $this->equipo->equipo_id
                ]);
            }
            // Devolver equipo
        } else {
            $res = event(new EquipoValidarEvent($this->equipo->equipo_id, $this->equipo->user_id, 0, 0, 1, 2));
            if ($res) {
                $this->emit('alert', 'success', 'Equipo proximo a devolver.');
            }
        }
    }
}
