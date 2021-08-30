<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\Helper;
use App\Models\User;
use App\Imports\UsersImport;
use App\Models\CentroTrabajo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;


class UserIndex extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $user, $roles, $centrotrabajos, $updateOrCreate = null, $userRolSelected = null, $centroTrabajoSelected = null, $file = null, $iteration;
    public $sort = 'id', $direction = 'desc';
    public $search = '';
    public $openEdit = false, $showDiv = null, $openUpload = false;
    public $cant = '10';

    protected $listeners = ['delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function rules()
    {

        $validations = [
            'user.name' => 'required|unique:users,name,' .  optional($this->user)->id,
            'user.email'    => 'required|email|unique:users,email,' .  optional($this->user)->id,
            'user.password' => 'required|confirmed',
            'centroTrabajoSelected' => 'required',
            'userRolSelected' => 'required',
        ];

        if ($this->updateOrCreate == "update") {
            unset($validations['user.password'],
            $validations['file']);
        }

        if ($this->openUpload == true) {
            $validations = [
                'file' => 'required|mimes:csv,txt|max:100'
            ];
        }

        return $validations;
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->centrotrabajos = CentroTrabajo::all();
    }

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
          

            // $users = DB::table('users')
            // ->join('centro_trabajos', 'centro_trabajos.id', '=', 'users.centro_trabajo_id')
            // ->where('users.name', 'LIKE', '%' . $this->search . '%')
            // ->select('centro_trabajos.nombre', 'users.*')
            // ->orderBy($this->sort, $this->direction)
            // ->paginate($this->cant);

        return view('livewire.admin.user-index', compact('users'));
    }

    public function order($sort)
    {
        $orders = Helper::order($this->sort, $sort, $this->direction);
        $this->sort = $orders[0];
        $this->direction = $orders[1];
    }

    private function resetUser()
    {
        $this->reset(['user', 'openEdit', 'file', 'openUpload']);
        $this->iteration++;
    }

    public function create()
    {
        $this->resetUser();
        $this->resetValidation();
        $this->updateOrCreate = "save";
        $this->showDiv = true;
        $this->openEdit = true;
        $this->userRolSelected = Role::get()->first()->id;
        $this->centroTrabajoSelected = CentroTrabajo::get()->first()->id;
    }

    public function createUpload()
    {
        $this->resetUser();
        $this->resetValidation();
        $this->openUpload = true;
    }

    public function updatedFile()
    {
        $this->validate();
    }

    public function saveUpload()
    {
        $this->validate();
        $file = $this->file->store('temp');
        Excel::import(new UsersImport, $file);
        $this->emit('alert', 'success', 'Carga masiva exitosa.');
        $this->resetUser();
    }

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'password' => bcrypt($this->user['password']),
            'centrotrabajo_id' => $this->centroTrabajoSelected,
        ])->assignRole($this->userRolSelected);

        $this->emit('alert', 'success', 'Creado con exito.');
        $this->resetUser();
    }

    public function edit(User $user)
    {
        $this->showDiv = false;
        $this->openEdit = true;
        $this->updateOrCreate = "update";
        $this->user = $user;
        
        if (empty($user->roles[0]->id)) {
            $this->userRolSelected = Role::get()->first()->id;;
        } else {
            $this->userRolSelected =  $user->roles[0]->id;
        }
        if (empty($this->user->centrotrabajo_id)) {
            $this->centroTrabajoSelected = Role::get()->first()->id;;
        }else{
            $this->centroTrabajoSelected = $this->user->centrotrabajo_id;
        }
        $this->validate();
    }

    public function update()
    {
        $this->validate();
        if ($this->user->id == auth()->id()) {
            if ($this->userRolSelected != $this->user->roles[0]->id) {
                //$this->user->update();
                $data = User::find($this->user->id);
                $data->update([
                    'name' => $this->user['name'],
                    'email' => $this->user['email'],
                    'password' => bcrypt($this->user['password']),
                    'centrotrabajo_id' => $this->centroTrabajoSelected,
                ]);

                $this->user->roles()->sync($this->userRolSelected);
                Auth::logout();
                return redirect()->route('admin.home');
            }
        } else {
            //$this->user->update();
            $data = User::find($this->user->id);
            $data->update([
                'name' => $this->user['name'],
                'email' => $this->user['email'],
                'password' => bcrypt($this->user['password']),
                'centrotrabajo_id' => $this->centroTrabajoSelected,
            ]);

            $this->user->roles()->sync($this->userRolSelected);
            $this->emit('alert', 'success', 'Editado con exito.');
            $this->resetUser();
        }
    }

    public function delete(User $user)
    {
        $user->delete();
        $this->resetPage();
    }
}
