<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
  
    use HasFactory;

    protected $table="rutas";

    protected $primaryKey="id_ruta";

    protected $fillable = [
        'descripcionRuta',
     
    ];

    public function Viajes(){
        return $this->hasOne(Viajes::class, 'id_viaje', 'id_viaje');
    }
}
