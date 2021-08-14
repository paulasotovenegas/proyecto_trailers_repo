<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viajes;
use App\Models\Empleado;
use App\Models\Ruta;
use App\Models\Trailer;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\ViajesExport;
use Maatwebsite\Excel\Facades\Excel;

class ViajesController extends Controller
{
    public function index()
    {
        $data = Viajes::latest()->paginate(8);

        return view('viajes.verViajes', compact('data'));
    }

    public function create()
    {
        $trailers = Trailer::select('*')->where('estado','=','Activo')->get();

        $empleados = Empleado::select('*')->where('estado','=','Activo')->get();

        $rutas = Ruta::select('*')->get();

        return view('viajes.ingresarViajes', compact('trailers', 'empleados', 'rutas'));
    }

    public function ingresarViaje(Request $request)
    {
        $request->validate([
            'fechaHoraLlegada' => ['nullable', 'date', 'after_or_equal:fechaHoraSalida'],
            'fechaHoraSalida' => ['required', 'date'],
            'tiempoDescarga' => ['nullable', 'string'],
            'peajes' => ['nullable', 'numeric', 'min:0', 'max:200000'],
            'diesel' => ['nullable','numeric', 'min:0', 'max:500000'],
            'gananciaBruta' => ['nullable', 'numeric', 'min:0', 'max:10000000'],
            'pagoEmpleado' => ['nullable', 'numeric', 'min:0', 'max:1000000'],
            'descripcionViaje' => ['nullable', 'string', 'max:150'],
            'descripcionCarga' => ['required', 'string', 'max:150'],
            'gananciaNeta' => ['nullable', 'numeric', 'min:0', 'max:10000000'],
            'id_trailer' => ['required', 'string', 'exists:trailers,id_trailer'],
            'id_ruta' => ['required', 'string', 'exists:rutas,id_ruta'],
            'id_empleado' => ['required', 'string', 'exists:empleados,id_empleado'],

        ]);

        $data = new viajes();

        $data->fechaHoraLlegada = $request["fechaHoraLlegada"];
        $data->fechaHoraSalida = $request["fechaHoraSalida"];
        $data->tiempoDescarga = $request["tiempoDescarga"];
        $data->peajes = $request["peajes"];
        $data->diesel = $request["diesel"];
        $data->gananciaBruta = $request["gananciaBruta"];
        $data->pagoEmpleado = $request["pagoEmpleado"];
        $data->descripcionViaje = $request["descripcionViaje"];
        $data->descripcionCarga = $request["descripcionCarga"];
        $data->gananciaNeta = $request["gananciaNeta"];
        $data->id_trailer = $request["id_trailer"];
        $data->id_ruta = $request["id_ruta"];
        $data->id_empleado = $request["id_empleado"];
        
        $data->save();

        return redirect()->back()->with("success", 'Dato guardado satisfactoriamente.');
    }


    public function edit($id)
    {
        $item = viajes::findOrFail($id);
        $trailers = Trailer::select('*')->where('estado','=','Activo')->get();
        $empleados = Empleado::select('*')->where('estado','=','Activo')->get();
        $rutas = Ruta::select('*')->get();

        $fechaHoraLlegada = str_replace(' ', 'T', $item->fechaHoraLlegada);
        $fechaHoraSalida = str_replace(' ', 'T', $item->fechaHoraSalida);

        return view('viajes.editarViajes', compact('item', 'fechaHoraLlegada', 'fechaHoraSalida', 'trailers', 'empleados', 'rutas'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([ 
            'fechaHoraLlegada' => ['nullable', 'date', 'after_or_equal:fechaHoraSalida'],
            'fechaHoraSalida' => ['required', 'date'],
            'tiempoDescarga' => ['nullable', 'string'],
            'peajes' => ['nullable', 'numeric', 'min:0', 'max:200000'],
            'diesel' => ['nullable','numeric', 'min:0', 'max:500000'],
            'gananciaBruta' => ['nullable', 'numeric', 'min:0', 'max:10000000'],
            'pagoEmpleado' => ['nullable', 'numeric', 'min:0', 'max:1000000'],
            'descripcionViaje' => ['nullable', 'string', 'max:150'],
            'descripcionCarga' => ['required', 'string', 'max:150'],
            'gananciaNeta' => ['nullable', 'numeric', 'min:0', 'max:10000000'],
            'id_trailer' => ['required', 'string', 'exists:trailers,id_trailer'],
            'id_ruta' => ['required', 'string', 'exists:rutas,id_ruta'],
            'id_empleado' => ['required', 'string', 'exists:empleados,id_empleado'],
        ]);
        

        $item = Viajes::findOrFail($id);
      
        $item->fechaHoraLlegada = $request["fechaHoraLlegada"];
        $item->fechaHoraSalida = $request["fechaHoraSalida"];
        $item->tiempoDescarga = $request["tiempoDescarga"];
        $item->peajes = $request["peajes"];
        $item->diesel = $request["diesel"];
        $item->gananciaBruta = $request["gananciaBruta"];
        $item->pagoEmpleado = $request["pagoEmpleado"];
        $item->descripcionViaje = $request["descripcionViaje"];
        $item->descripcionCarga = $request["descripcionCarga"];
        $item->gananciaNeta = $request["gananciaNeta"];
        $item->id_trailer = $request["id_trailer"];
        $item->id_ruta = $request["id_ruta"];
        $item->id_empleado = $request["id_empleado"];
      
           
  

        $item->update();

        return redirect()->back()->with("success", 'Viaje editado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $item = viajes::findOrFail($id);

        $item->delete();

        return redirect()->back()->with("success", 'Viaje eliminado satisfactoriamente.');
    }

    public function buscar(Request $request)
    {

        $descripcionViaje = $request['buscar'];

        $data = Viajes::where('descripcionViaje', 'like', "%$descripcionViaje%")->paginate(8);
        if ($data != null) {
            $data2 = [];

            foreach ($data as $item) {
                if ($item->id_trailer == null) {
                    $placa = "";
                } else {
                    $placa = $item->trailer->placaTrailer;
                }

                if ($item->id_ruta == null) {
                    $ruta = "";
                } else {
                    $ruta = $item->ruta->descripcionRuta;
                }

                if ($item->id_empleado == null) {
                    $empleado = "";
                } else {
                    $empleado = $item->empleado->nombre;
                }

                $data2[] = [
                    "id_viaje" => $item->id_viaje,
                    "fechaHoraLlegada" => $item->fechaHoraLlegada,
                    "fechaHoraSalida" => $item->fechaHoraSalida,
                    "tiempoDescarga" => $item->tiempoDescarga,
                    "peajes" => $item->peajes,
                    "diesel" => $item->diesel,
                    "gananciaBruta" => $item->gananciaBruta,
                    "pagoEmpleado" => $item->pagoEmpleado,
                    "descripcionViaje" => $item->descripcionViaje,
                    "descripcionCarga" => $item->descripcionCarga,
                    "gananciaNeta" => $item->gananciaNeta,
                    "id_trailer" => $placa,
                    "id_ruta" => $ruta,
                    "id_empleado" => $empleado
                ];
            }

            return response()->json($data2);
        }
    }


    public function reporteViajes()
    {
        $data = viajes::latest()->paginate(8);

        return view('reportes.reporteViajes', compact('data'));
    }

    public function PDF()
    {
        //$pdf = new PDF();
        $data = Viajes::latest()->get();

        $pdf = PDF::loadView('reportes.pdfViajes', compact('data'));
        return   $pdf->download('Reporte de Viajes.pdf');
    }


    public function buscarFecha(Request $request)
    {
    
        if ($request['bd_desde'] == "" || $request['bd_hasta'] == "") {
            $data = Viajes::latest()->paginate(8);
            return view('reportes.reporteViajes', compact('data'));
        } else {

            $fecha1 = $request['bd_desde'];
            $fecha2 = $request['bd_hasta'];
            $data = Viajes::whereBetween('fechaHoraSalida', [$fecha1, $fecha2])->paginate(8);
            return view('reportes.reporteViajes', compact('data'));
        }
    }

    public function Excel(){

        $data = Viajes::latest()->get();

        return Excel::download(new ViajesExport, 'Reporte de Viajes.xlsx');

    }
}
