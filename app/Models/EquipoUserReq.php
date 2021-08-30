<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoUserReq extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','equipo_id', 'status', 'status_req', 'status_req_user'];


    // Relacion one to many Inversa de EquipoUserReq -> User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion one to many Inversa de EquipoUserReq -> Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
