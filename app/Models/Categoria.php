<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;


class Categoria extends Model
{
    use HasFactory;

    // Cargas masivas, solo los inputs permitidos.
    protected $fillable = ['nombre'];

    // Relacion uno a muchos Categoria -> Equipos
    // Una Categoria puede estar muchas veces en equipos.
    public function equipos(){
        return $this->hasMany(Equipo::class);
    }

}
