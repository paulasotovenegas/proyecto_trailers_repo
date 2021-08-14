<?php

namespace App\Exports;

use App\Models\Trailer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrailerExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'Id Trailer',
            'Placa Tráiler',
            'Tarjeta Pesos y Dimensiones',
            'Riteve',
            'Marchamo',
            'Tarjeta Transporte Peligroso',
            'Código Transportista',
        ];
    }
    public function collection()
    {
        return Trailer::select(
            'id_trailer',
            'placaTrailer',
            'tarjetaPesosDimensiones',
            'riteve',
            'marchamo',
            'tarjetaTransportePeligroso',
            'codigoTransportista'
        )->where('id_trailer','>',1)->get();
    }
}
