<?php

namespace App\Exports;

use App\Models\Viajes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ViajesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'Id Viaje',
            'Fecha y Hora de Salida',
            'Fecha y Hora de Llegada',
            'Tiempo de Descarga',
            'Peajes',
            'Diesel',
            'Ganancia Bruta',
            'Pago de Empleado',
            'Descripcion del Viaje',
            'Descripcion de la Carga',
            'Ganancia Neta',
            'Trailer Encargado',
            'Ruta',
            'Empleado',

        ];
    }
    public function collection()
    {
        return Viajes::leftJoin('trailers', 'viajes.id_trailer', '=', 'trailers.id_trailer')
            ->leftJoin('rutas', 'viajes.id_ruta', '=', 'rutas.id_ruta')
            ->leftJoin('empleados', 'viajes.id_empleado', '=', 'empleados.id_empleado')
            ->select(
                'id_viaje',
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
                'trailers.placaTrailer',
                'rutas.descripcionRuta',
                'empleados.nombre'
            )->get();
    }
}
