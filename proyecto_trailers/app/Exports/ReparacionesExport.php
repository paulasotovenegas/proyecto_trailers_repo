<?php

namespace App\Exports;

use App\Models\Reparaciones;
use App\Models\Trailer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ReparacionesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'Placa Tráiler',
            'Descripción',
            'Fecha Reparación',
            'Fecha Daño',
            'Observaciones',
            'Costo',
            'Duración',
        ];
    }
    public function collection()
    {

        return Reparaciones::leftJoin('trailers', 'reparaciones.id_trailer', '=', 'trailers.id_trailer')
            ->select(
                'trailers.placaTrailer',
                'descripcionReparacion',
                'fechaReparacion',
                'FechaDano',
                'observaciones',
                'costo',
                'duracion'
            )->get();
    }
}
