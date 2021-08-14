<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparaciones extends Model
{
    use HasFactory;

    protected $table = "reparaciones";

    protected $primaryKey = "id_reparacion";

    protected $fillable = [
        'descripcionReparacion',
        'fechaReparacion',
        'fechaDano',
        'observaciones',
        'costo',
        'duracion',
        'id_trailer',

    ];

    public function trailer(){
        return $this->hasOne(trailer::class, 'id_trailer', 'id_trailer');
    }
}


    