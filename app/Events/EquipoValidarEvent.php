<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EquipoValidarEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $equipo_id, $user_id, $status, $status_req, $status_req_user, $flag_fecha;
 

    public function __construct($equipo_id, $user_id, $status, $status_req, $status_req_user, $flag_fecha)
    {
        $this->equipo_id = $equipo_id;
        $this->user_id = $user_id;
        $this->status = $status;
        $this->status_req = $status_req;
        $this->status_req_user = $status_req_user;
        $this->flag_fecha = $flag_fecha;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
