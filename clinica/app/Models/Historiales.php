<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historiales extends Model
{
    use HasFactory;

    public function pacientes(){
        return $this->belongsTo('App\Models\Pacientes');
    }

    public function usuarios(){
        return $this->belongsTo('App\Models\Usuarios');
    }
}
