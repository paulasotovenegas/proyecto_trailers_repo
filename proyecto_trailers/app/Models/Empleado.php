<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table="empleados";

    protected $primaryKey="id_empleado";

    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'fechaNacimiento',
        'tipoCedula',
        'numeroCedula',
        'otrasReferencias',
        'sexo',
        'numeroTelefono',
        'email',
        'observaciones',
        'estado',
        'provincia',
        'canton',
        'distrito',
        'id_trailer',
        'tipoLicencia',
        'fechaVencimientoLicencia',
    
    ];


    public function trailer(){
        return $this->hasOne(Trailer::class, 'id_trailer', 'id_trailer');
    }
}
