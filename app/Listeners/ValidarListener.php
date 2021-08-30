<?php

namespace App\Listeners;

use App\Events\ValidarEvent;
use App\Models\CategoriaUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ValidarListener
{
    public function handle(ValidarEvent $event)
    {
        $categoria_id = $event->categoria_id;
        $user_id = $event->user_id;
        $flag_devolucion = $event->flag_devolucion;
        //dd("user_id" . $user_id);
        
       
        // Caso: asignacion de equipo.
        if($flag_devolucion == 0){

            $categoria_user = CategoriaUser::where('user_id', $user_id)
                                    ->Where('categoria_id', $categoria_id)->get();
          
            // Categoria no repetida. Puede asignar el equipo.
             if($categoria_user->isEmpty())
             {
                 //dd($user_id . " " . $categoria_id);
                return true;
            }else{
                //dd("retorna false ya tiene categoria");
                return false;
             }
        }else{
            // Caso: devolucion de equipo.
            CategoriaUser::where('user_id', $user_id)
                        ->Where('categoria_id', $categoria_id)->delete();
        }
        
    }
}
