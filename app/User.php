<?php

namespace App;
use App\Skill;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'puesto',
        'fecha_nac',
        'domicilio',
    ];

         public function skills()
    {
        //Relacion de 1 a muchos 
        return $this->hasMany(Skill::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'remember_token',
    ];
}
