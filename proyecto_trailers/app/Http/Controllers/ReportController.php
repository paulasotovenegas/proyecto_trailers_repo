<?php

namespace App\Http\Controllers;

use App\Models\Reparaciones;
use App\Models\Ruta;
use App\Models\Viajes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportViajes(Request $request)
    {

        $viajes = [];

        $viajes = Viajes::select('*')->whereBetween('fechaHoraSalida', [$request['param1'], $request['param2']])->get();

        $report = [];

        foreach ($viajes as $item) {
            $report[] = [
                'Viaje' => $item->descripcionViaje,
                'Ganancia' => $item->gananciaNeta,
            ];
        }

        return response()->json($report);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteReparaciones()
    {
        $reparaciones = Reparaciones::all();

        $reporte = [];

        foreach ($reparaciones as $reparacion) {

            $count = 0;

            foreach ($reparaciones as $item) {

                if ($reparacion->trailer->placaTrailer == $item->trailer->placaTrailer) {

                    $count += 1;
                }
            }
            if ($count > 0) {
                $reporte[] = [
                    'Viaje' => $reparacion->trailer->placaTrailer,
                    'Cantidad' => $count,
                ];
            }
        }

        $reporte = array_unique($reporte, SORT_REGULAR);

        return response()->json($reporte);
    }

    public function rutasReport()
    {

        $rutas = Viajes::all();

        $reporte = [];

        foreach ($rutas as $ruta) {

            $count = 0;

            foreach ($rutas as $item) {

                if ($ruta->ruta->descripcionRuta == $item->ruta->descripcionRuta) {

                    $count += 1;
                }
            }
            if ($count > 0) {
                $reporte[] = [
                    'Ruta' => $ruta->ruta->descripcionRuta,
                    'Cantidad' => $count,
                ];
            }
        }

        $reporte = array_unique($reporte, SORT_REGULAR);
        
        return response()->json($reporte);
    }



       //* $rutas = Ruta::all();

        //*$reporte = [];

        //* foreach ($rutas as $ruta) {

           //* $count = 0;

           //* foreach ($rutas as $item) {

               //* if ($ruta->descripcionRuta == $item->descripcionRuta) {

                  //*  $count += 1;
             //*   }
           //* }

           //* $reporte[] = [
              //*  'Ruta' => $ruta->descripcionRuta,
               //* 'Cantidad' => $count,
           //* ];
       //* }

       //* $reporte = array_unique($reporte, SORT_REGULAR);

       //* return response()->json($reporte);
    }

