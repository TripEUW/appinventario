<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ValidarEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $categoria_id;
    public $user_id;
    public $flag_devolucion;

    public function __construct($categoria_id, $user_id, $flag_devolucion)
    {
        $this->categoria_id = $categoria_id;
        $this->user_id = $user_id;
        $this->flag_devolucion = $flag_devolucion;
        
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
