<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Ruta;
use App\Models\Viajes;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\RutaExport;
use Maatwebsite\Excel\Facades\Excel;

class RutaController extends Controller
{
    public function index(){
        $data = Ruta::latest()->where('id_ruta','>',1)->paginate(8);

        return view('rutas.verRutas', compact('data'));
    }

    public function reporteRutas(){
        $data = Ruta::latest()->where('id_ruta','>',1)->paginate(8);

        return view('reportes.reporteRutas', compact('data'));
    }
    

    public function ingresarRuta(Request $request)
    {
        $request->validate([
          
         
            'descripcionRuta' => ['required','unique:rutas', 'string', 'max:150'],
         
        ]);

       $data = new Ruta();

       $data->descripcionRuta = $request["descripcionRuta"];
      

        

       $data->save();

       return redirect()->back()->with("success",'Dato guardado satisfactoriamente.');
    }      


    public function edit($id){
        $item = Ruta::findOrFail($id);

        return view('rutas.editarRutas', compact('item'));
    }


    public function update(Request $request, $id){
        $request->validate([

            'descripcionRuta' => ['required', 'unique:rutas', 'string', 'max:150'],




        ]);


     
        $item = Ruta::findOrFail($id);
        $item->descripcionRuta = $request["descripcionRuta"];
        $item->update();

        return redirect()->back()->with("success",'Ruta Editada Satisfactoriamente.');
    }






    public function destroy($id){
        $item = Ruta::findOrFail($id);

        $item->delete();

        return redirect()->back()->with("success",'Ruta Eliminada Satisfactoriamente.');
    }

    public function buscar(Request $request){
    
        $descripcionRuta = $request['buscar'];

        $data = Ruta::where('descripcionRuta','like',"%$descripcionRuta%")->where('id_ruta','>',1)->paginate(8);
        
        return response()->json($data);
    }

    public function PDF()
    {
        //$pdf = new PDF();
        $data = Ruta::latest()->where('id_ruta','>',1)->get();

        $pdf = PDF::loadView('reportes.pdfRuta', compact('data'));
        return   $pdf->download('Reporte de Rutas.pdf');
    } 

    public function Excel(){

        $data = Ruta::latest()->where('id_ruta','>',1)->get();

        return Excel::download(new RutaExport, 'Reporte de Rutas.xlsx');

    }
}
