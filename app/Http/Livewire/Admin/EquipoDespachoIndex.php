<?php

namespace App\Http\Livewire\Admin;

use App\Events\EquipoValidarEvent;
use App\Helpers\Helper;
use App\Models\Equipo;
use App\Models\EquipoUser;
use App\Models\EquipoUserReq;
use Livewire\Component;

class EquipoDespachoIndex extends Component
{
    public $cant = '10';
    public $search = '';
    public $sort = 'status';
    public $direction = 'desc';
    public $equipo, $userSelected = "vacio";

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function render()
    {
        if ($this->search == "") {
            $equipos = EquipoUserReq::orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $equipos = EquipoUserReq::where('status', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->latest('status')
                ->paginate($this->cant);
        }

        return view('livewire.admin.equipo-despacho-index', compact('equipos'));
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
        // Despachar equipo
        if ($flag == 1) {

            $res = event(new EquipoValidarEvent($this->equipo->equipo_id, $this->equipo->user_id, 1, 1, 0, 1));

            if ($res) {
                $this->emit('alert', 'success', 'Equipo Despachado.');
            }
            // Equipo recuperado   
        } else {
            $res = event(new EquipoValidarEvent($this->equipo->equipo_id, $this->equipo->user_id, 0, 1, 1, 1));

            if ($res) {
                $this->emit('alert', 'success', 'Equipo Recuperado.');
                EquipoUser::create([
                    'status' => 0,
                    'user_id' => $this->equipo->user_id,
                    'equipo_id' => $this->equipo->equipo_id
                ]);

                Equipo::where('id', $this->equipo->equipo_id)->update(['status' => false]);

            }
        }
    }
}
