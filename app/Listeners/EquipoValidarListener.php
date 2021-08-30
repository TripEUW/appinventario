<?php

namespace App\Listeners;

use App\Events\EquipoValidarEvent;
use App\Models\EquipoUserReq;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class EquipoValidarListener
{
    public function handle(EquipoValidarEvent $event)
    {
        $equipo_id = $event->equipo_id;
        $user_id = $event->user_id;
        $status = $event->status;
        $status_req = $event->status_req;
        $status_req_user = $event->status_req_user;
        $flag_fecha = $event->flag_fecha;


        $exists = EquipoUserReq::where('equipo_id', $equipo_id)->where('user_id', $user_id)->exists();


        if ($exists) {
            switch ($flag_fecha) {
                case '1':
                    $arg1 = now();
                    $arg2 = DB::raw('`fecha_status_req_user`');
                    break;
                case '2':
                    $arg1 = DB::raw('`fecha_status_req`');
                    $arg2 = now();
                    break;
                default:
                    $arg1 = null;
                    $arg2 = null;
                    break;
            }
            EquipoUserReq::where('equipo_id', $equipo_id)
                ->where('user_id', $user_id)
                ->update([
                    'status' => $status,
                    'status_req' => $status_req,
                    'status_req_user' => $status_req_user,
                    'fecha_status_req' => $arg1,
                    'fecha_status_req_user' => $arg2
                ]);
        } else {
            EquipoUserReq::create([
                'status' => $status,
                'status_req' => $status_req,
                'status_req_user' => $status_req_user,
                'user_id' => $user_id,
                'equipo_id' => $equipo_id
            ]);
        }
    }
}
