<?php

namespace App\Exports;
use App\Models\Bitacora;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class BitacoraExport implements  FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id Bitácora',
            'Fecha',
            'Acción',
            'Usuario',

        ];
    }


    public function collection()
    {
        return Bitacora::select(
            'id_bitacora',
            'fecha',
            'accion',
            'usuario'
        )->get();
    }
}
