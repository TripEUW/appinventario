<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Categoria;

class CategoriaUser extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'status', 'categoria_id'];
    // Relacion one to many Inversa de CategoriaUser -> User
    // un solo usuario tiene un registro en la tabla CategoryUser
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Relacion one to many Inversa de CategoriaUser -> Categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
