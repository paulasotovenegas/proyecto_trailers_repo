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
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 0c5c2abd244927e0fd71fb58a7eb35c5592876e0
=======
>>>>>>> 0c5c2abd244927e0fd71fb58a7eb35c5592876e0
