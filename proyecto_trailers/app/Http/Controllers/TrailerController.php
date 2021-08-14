<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Trailer;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\TrailerExport;
use Maatwebsite\Excel\Facades\Excel;

class TrailerController extends Controller
{
    public function index()
    {
        $data = Trailer::latest()->where('id_trailer','>',1)->paginate(8);

        return view('trailers.verTrailers', compact('data'));
    }

    public function ingresarTrailer(Request $request)
    {
        $request->validate([
            'placaTrailer' => ['required', 'unique:trailers', 'string', 'max:13'],
            'tarjetaPesosDimensiones' => ['required', 'date'],
            'riteve' => ['required', 'date'],
          
            'marchamo' => ['required', 'date'],
            'tarjetaTransportePeligroso' => ['required', 'date'],
            'codigoTransportista' => ['nullable', 'string', 'max:30'],


        ]);

        $data = new Trailer();

        $data->placaTrailer = $request["placaTrailer"];
        $data->tarjetaPesosDimensiones = $request["tarjetaPesosDimensiones"];
        $data->riteve = $request["riteve"];
        $data->marchamo = $request["marchamo"];
        $data->estado = 'Activo';
        $data->tarjetaTransportePeligroso = $request["tarjetaTransportePeligroso"];
        $data->codigoTransportista = $request["codigoTransportista"];

        $data->save();

        return redirect()->back()->with("success", 'Dato guardado satisfactoriamente.');
    }


    public function edit($id)
    {
        $item = Trailer::findOrFail($id);
        return view('trailers.editarTrailers', compact('item'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            
            'tarjetaPesosDimensiones' => ['required', 'date'],
            'riteve' => ['required', 'date'],
            'marchamo' => ['required', 'date'],
            'tarjetaTransportePeligroso' => ['required', 'date'],
            'codigoTransportista' => ['nullable', 'string', 'max:30'],
        ]);


        $item = Trailer::findOrFail($id);
      
        $item->tarjetaPesosDimensiones = $request["tarjetaPesosDimensiones"];
        $item->riteve = $request["riteve"];
        $item->marchamo = $request["marchamo"];
        $item->tarjetaTransportePeligroso = $request["tarjetaTransportePeligroso"];
        $item->codigoTransportista = $request["codigoTransportista"];

        $item->update();

        return redirect()->back()->with("success", 'Trailer editado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $item = Trailer::findOrFail($id);

        $item->delete();

        return redirect()->back()->with("success", 'Trailer eliminado satisfactoriamente.');
    }

    public function buscar(Request $request)
    { {

            $placaTrailer = $request['buscar'];

            $data = Trailer::where('placaTrailer', 'like', "%$placaTrailer%")->where('id_trailer','>',1)->paginate(8);

            $data2 = [];

            foreach ($data as $item) {


                $data2[] = [
                    "id_trailer" => $item->id_trailer,
                    "placaTrailer" => $item->placaTrailer,
                    "tarjetaPesosDimensiones" => $item->tarjetaPesosDimensiones,
                    "riteve" =>  $item->riteve,
                    "marchamo" =>  $item->marchamo,
                    "tarjetaTransportePeligroso" => $item->tarjetaTransportePeligroso,
                    "codigoTransportista" =>  $item->codigoTransportista

                ];
            }

            return response()->json($data2);
        }
    }

    public function reporteTrailers()
    {
        $data = Trailer::latest()->where('id_trailer','>',1)->paginate(8);

        return view('reportes.reporteTrailer', compact('data'));
    }

    public function PDF()
    {
        //$pdf = new PDF();
        $data = Trailer::latest()->where('id_trailer','>',1)->get();

        $pdf = PDF::loadView('reportes.pdfTrailers', compact('data'));
        return   $pdf->download('Reporte de Trailers.pdf');
    }

    public function Excel(){

        $data = Trailer::latest()->where('id_trailer','>',1)->get();

        return Excel::download(new TrailerExport, 'Reporte de Trailers.xlsx');

    }
}