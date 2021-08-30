<?php

namespace App\Models;

use App\Events\ProductUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Equipo;

class EquipoUser extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','equipo_id', 'status'];

    // Relacion one to many Inversa de EquipoUser -> User
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Relacion one to many Inversa de EquipoUser -> Equipo
    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }
}
