<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turnos extends Model
{
    use HasFactory;

    //protected $table='turnos';
	//protected $primaryKey='id';

    public function pacientes(){
        return $this->belongsTo('App\Models\Pacientes');
    }

    public function usuarios(){
        return $this->belongsTo('App\Models\Usuarios');
    }
}
