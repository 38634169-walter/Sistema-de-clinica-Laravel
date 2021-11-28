<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;

    //protected $table='pacientes';
	//protected $primaryKey='id';

    public function historiales(){
        return $this->hasMany('App\Models\Historiales');
    }

    public function turnos(){
        return $this->hasMany('App\Models\Turnos');
    }
}
