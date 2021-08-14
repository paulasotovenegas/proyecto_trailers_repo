<?php

namespace App\Exports;

use App\Models\Ruta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RutaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'Código Ruta',
            'Descripción Ruta',
        ];
    }
    public function collection()
    {
        return Ruta::select('id_ruta', 'descripcionRuta')->where('id_ruta','>',1)->get();
    }
}
