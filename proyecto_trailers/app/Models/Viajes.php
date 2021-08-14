<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viajes extends Model
{
    use HasFactory;

    protected $table = "viajes";

    protected $primaryKey = "id_viaje";

    protected $fillable = [
        'fechaHoraLlegada',
        'fechaHoraSalida',
        'tiempoDescarga',
        'peajes',
        'diesel',
        'gananciaBruta',
        'pagoEmpleado',
        'descripcionViaje',
        'descripcionCarga',
        'gananciaNeta',
        'id_trailer',
        'id_ruta',
        'id_empleado',

    ];

    public function empleado(){
        return $this->hasOne(Empleado::class, 'id_empleado', 'id_empleado');
    }

    public function ruta(){
        return $this->hasOne(Ruta::class, 'id_ruta', 'id_ruta');
    }
    
    public function trailer(){
        return $this->hasOne(Trailer::class, 'id_trailer', 'id_trailer');
    }
}
