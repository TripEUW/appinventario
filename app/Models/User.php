<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\CategoriaUser;
use App\Models\EquipoUser;
use App\Models\Equipo;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'centrotrabajo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Relacion one to many  User -> CategoriaUser
    // Un usuario puede estar en esta tabla varias veces.
    public function categoriausers(){
        // Este metodo recupera la coleccion de categoryuser
        // que le pertenece a este usuario
        return $this->hasMany(CategoriaUser::class);
    }
    
    // Relacion one to many  User -> EquipoUser
    public function equipousers(){
        // Este metodo recupera la coleccion de EquipoUser
        // que le pertenece a este usuario
        return $this->hasMany(EquipoUser::class);
    }

    // Relacion one to many User -> Equipo
    public function equipos(){
        return $this->hasMany(Equipo::class);
    }
    
    // Un modelo solo tiene una marca.
    // Relacion uno a muchos Inversa Modelo -> Marca
    public function centrotrabajo(){
        return $this->belongsTo(CentroTrabajo::class);
    }


    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }
 
}
