<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Reparaciones;
use App\Models\Trailer;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\ReparacionesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReparacionesController extends Controller
{
    public function index()
    {
        $data = Reparaciones::latest()->paginate(8);

        return view('reparaciones.verReparaciones', compact('data'));
    }

    public function comboTrailers()

    {

        $trailers = Trailer::select('*')->get();

        return view('reparaciones.ingresarReparaciones', compact('trailers'));
    }



    public function ingresarReparacion(Request $request)
    {
        $request->validate([
            'descripcionReparacion' => ['required', 'string', 'max:150'],
            'fechaReparacion' => ['required', 'date'],
            'fechaDano' => ['nullable', 'date', 'after_or_equal:fechaReparacion'],
            'observaciones' => ['nullable', 'string', 'max:150'],
            'costo' => ['nullable','numeric', 'min:0', 'max:1000000'],
            'duracion' => ['nullable', 'string'],
            'id_trailer' => ['required', 'exists:trailers,id_trailer'],

        ]);

        $data = new Reparaciones();
        $fechaReparacion = $request["fechaReparacion"];
        $fechaDano =  $request["fechaDano"];
        $data->descripcionReparacion = $request["descripcionReparacion"];
        $data->fechaReparacion = $fechaReparacion;
        $data->fechaDano = $fechaDano;
        $data->observaciones = $request["observaciones"];
        $data->costo = $request["costo"];
        $data->duracion = $request["duracion"];
        $data->id_trailer = $request["id_trailer"];

        $data->save();

        return redirect()->back()->with("success", 'Dato Guardado Satisfactoriamente.');
    }


    public function edit($id)
    {
        $item = Reparaciones::findOrFail($id);
        $trailers = Trailer::select('*')->get();
        return view('reparaciones.editarReparaciones', compact('item', 'trailers'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'descripcionReparacion' => ['required', 'string', 'max:150'],
            'fechaReparacion' => ['required', 'date'],
            'fechaDano' => ['nullable', 'date', 'after_or_equal:fechaReparacion'],
            'observaciones' => ['nullable', 'string', 'max:150'],
            'costo' => ['nullable','numeric', 'min:0', 'max:1000000'],
            'duracion' => ['nullable', 'string'],
            'id_trailer' => ['required', 'exists:trailers,id_trailer'],

        ]);

        $item = Reparaciones::findOrFail($id);

        $data = $request->all();

        $item->update($data);

        return redirect()->back()->with("success", 'Reparación Editada Satisfactoriamente.');
    }

    public function destroy($id)
    {
        $item = Reparaciones::findOrFail($id);

        $item->delete();

        return redirect()->back()->with("success", 'Reparación Eliminada Satisfactoriamente.');
    }


    public function buscar(Request $request)
    {

        $descripcionReparacion = $request['buscar'];

        $data = Reparaciones::where('descripcionReparacion', 'like', "%$descripcionReparacion%")->paginate(8);
        if($data != null){
        $data2 = [];
      
        foreach ($data as $item) {
            if ($item->id_trailer == null) {
                $placa = "";
            } else {
                $placa = $item->trailer->placaTrailer;
            }

            $data2[] = [
                "id_reparacion" => $item->id_reparacion,
                    "descripcionReparacion" => $item->descripcionReparacion,
                    "fechaReparacion" => $item->fechaReparacion,
                    "fechaDano" => $item->fechaDano,
                    "observaciones" => $item->observaciones,
                    "costo" => $item->costo,
                    "duracion" => $item->duracion,
                    "id_trailer" =>  $placa
            ];
        }

        return response()->json($data2);
    }
  }

    public function reporteReparaciones()
    {
        $data = Reparaciones::latest()->paginate(8);

        return view('reportes.reporteReparaciones', compact('data'));
    }

    public function PDF()
    {
        //$pdf = new PDF();
        $data = Reparaciones::latest()->get();

        $pdf = PDF::loadView('reportes.pdfReparaciones', compact('data'));
        return   $pdf->download('Reporte de Reparaciones.pdf');
    }

    public function Excel(){

        $data = Reparaciones::latest()->get();

        return Excel::download(new ReparacionesExport, 'Reporte de Reparaciones.xlsx');

    }
}
