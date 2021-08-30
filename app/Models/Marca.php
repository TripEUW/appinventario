<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;
use App\Models\Modelo;

class Marca extends Model
{
    use HasFactory;
    // Cargas masivas, solo los inputs permitidos.
    protected $fillable = ['nombre'];
    
    // Relacion uno a muchos Marca -> Equipo
    // Una marca puede estar muchas veces en equipos.
    public function equipos(){
        return $this->hasMany(Equipo::class);
    }
    

    // Relacion uno a muchos Marca -> Modelo
    // Una marca puede tener muchos modelos.
    public function modelos(){
        return $this->hasMany(Modelo::class);
    }

}
