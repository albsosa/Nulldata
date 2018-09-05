<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
     protected $fillable = [
        'nombre',
        'calificacion',
        'user_id'
    ];
     public function User()
    {
    	//Relacion de muchos a uno 
    	return $this->belongsTo(User::class);
    }
}
