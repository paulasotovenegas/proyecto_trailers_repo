<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BitacoraExport;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('navbar.navbar');
    }

    public function PDF()
    {
        //$pdf = new PDF();
        $data = Bitacora::latest()->get();

        $pdf = PDF::loadView('reportes.pdfBitacora', compact('data'));
        return   $pdf->download('Reporte de Bitacora.pdf');
    } 


    public function reporteBitacora(){
        $data = Bitacora::latest()->paginate(8);

        return view('reportes.bitacora', compact('data'));
    }

    public function buscarFechaBitacora(Request $request)
    {
    
        if ($request['bd_desde'] == "" || $request['bd_hasta'] == "") {
            $data = Bitacora::latest()->paginate(8);
            return view('reportes.bitacora', compact('data'));
        } else {

            $fecha1 = $request['bd_desde'];
            $fecha2 = $request['bd_hasta'];
            $data = Bitacora::whereBetween('fecha', [$fecha1, $fecha2])->paginate(8);
            return view('reportes.bitacora', compact('data'));
        }
}
public function Excel()
{

    $data = Bitacora::latest()->get();

    return Excel::download(new BitacoraExport, 'Reporte de Bitácora.xlsx');
}
}
