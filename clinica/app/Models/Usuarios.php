<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    public function cargos(){
        return $this->belongsTo('App\Models\Cargos');
    }

    public function historiales(){
        return $this->hasMany('App\Models\Historiales');
    }

    public function turnos(){
        return $this->hasMany('App\Models\Turnos');
    }
}
