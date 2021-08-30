<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Categoria;
use App\Models\EquipoUser;
use App\Models\User;

class Equipo extends Model
{
    use HasFactory;

    // Cargas masivas, solo los inputs permitidos.
    protected $fillable = ['id','nombre','marca_id','modelo_id','categoria_id', 'descripcion', 'fecha_compra'];

    // Relacion one to many Inversa de Equipo -> Marca
    // Un equipo solo tiene una marca.
    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    // Relacion one to many Inversa de Equipo -> Modelo
    public function modelo(){
        return $this->belongsTo(Modelo::class);
    }
 
    // Relacion one to many Inversa de Equipo -> Categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    // Relacion one to many  Equipo -> EquipoUser
    public function equipousers(){
        // Este metodo recupera la coleccion de EquipoUser
        // que le pertenece a este equipo
        return $this->hasMany(EquipoUser::class);
    }

    // Relacion one to many Inversa de Equipo -> User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
