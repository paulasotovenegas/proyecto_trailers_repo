<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleadoExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'Id Empleado',
            'Número de Cédula',
            'Nombre',
            'Primer Apellido',
            'Segundo Apellido',
            'Número de Teléfono',
            'Provincia',
            'Cantón',
            'Distrito',
            'Trailer Encargado',
            'Email',
            'Fecha de Vencimiento Licencia',

        ];
    }

    public function collection()
    {
      
        return Empleado::leftJoin('trailers', 'empleados.id_trailer', '=', 'trailers.id_trailer')
            ->select(
                'id_empleado',
                'numeroCedula',
                'nombre',
                'apellido1',
                'apellido2',
                'numeroTelefono',
                'provincia',
                'canton',
                'distrito',
                'trailers.placaTrailer',
                'email',
                'fechaVencimientoLicencia'
            )->where('id_empleado','>',1)->get();
    }
}
