<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trailer extends Model
{
    use HasFactory;

    protected $table = "trailers";

    protected $primaryKey = "id_trailer";

    protected $fillable = [
        'placaTrailer',
        'tarjetaPesosDimensiones',
        'riteve',
        'estado',
        'marchamo',
        'tarjetaTransportePeligroso',
        'codigoTransportista',

    ];

    
}
