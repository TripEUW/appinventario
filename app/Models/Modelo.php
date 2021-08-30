<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;
use App\Models\Marca;

class Modelo extends Model
{
    use HasFactory;

        // Cargas masivas, solo los inputs permitidos.
    protected $fillable = ['nombre', 'marca_id'];

    // Relacion uno a muchos Modelo -> Equipo
    // Un modelo puede estar muchas veces en equipos.
    public function equipos(){
        return $this->hasMany(Equipo::class);
    }

    // Un modelo solo tiene una marca.
    // Relacion uno a muchos Inversa Modelo -> Marca
    public function marca(){
        return $this->belongsTo(Marca::class);
    }
}
