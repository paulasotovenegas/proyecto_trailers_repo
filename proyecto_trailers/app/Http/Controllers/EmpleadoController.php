<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Empleado;
use App\Models\Viajes;
use App\Models\Trailer;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\EmpleadoExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;


class EmpleadoController extends Controller
{

    public function __construct()

    {

        $this->middleware('verified');
    }

    public function index()
    {
        $data = Empleado::latest()->where('id_empleado', '>', 1)->paginate(8);

        return view('empleados.verEmpleados', compact('data'));
    }


    public function apiProvincia()

    {
        $respuesta =  Http::get('https://ubicaciones.paginasweb.cr/provincias.json');
        $respuestaProvincia = $respuesta->json();
        //dd($respuestaProvincia);
        $trailers = Trailer::select('*')->get();

        return view('empleados.ingresarEmpleados', compact('respuestaProvincia', 'trailers'));
    }


    public function apiCanton(Request $request)
    {
        $url = 'https://ubicaciones.paginasweb.cr/provincia/' . $request["provinciaSelect"] . '/cantones.json';

        $respuesta =  Http::get($url);

        $array = json_decode($respuesta);

        return response()->json($array);
    }

    public function apiDistrito(Request $request)
    {
        $input = $request->all();

        $url = 'https://ubicaciones.paginasweb.cr/provincia/' . $input["provinciaSelect"] . '/canton/' . $input["cantonSelect"] . '/distritos.json';

        $respuestaDistrito =  Http::get($url);

        $array = json_decode($respuestaDistrito);

        return response()->json($array);
    }

    public function ingresarEmpleado(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:4','max:30'],
            'apellido1' => ['required', 'string', 'min:4', 'max:30'],
            'apellido2' => ['nullable', 'string', 'max:30'],
            'fechaNacimiento' => ['nullable', 'date'],
            'tipoCedula' => ['required', 'string', 'max:30'],
            'numeroCedula' => ['required', 'unique:empleados', 'string', 'min:9', 'max:30'],
            'otrasReferencias' => ['nullable', 'string', 'max:100'],
            'sexo' => ['required', 'string', 'max:20'],
            'numeroTelefono' => ['required', 'string', 'digits_between:8,20'],
            'email' => ['nullable', 'unique:empleados','string', 'email', 'max:30'],
            'observaciones' => ['nullable', 'string', 'max:100'],
            'provincia' => ['nullable', 'string'],
            'canton' => ['nullable', 'string'],
            'distrito' => ['nullable', 'string'],
            'id_trailer' => ['required', 'exists:trailers,id_trailer'],
            'tipoLicencia' => ['required', 'string', 'max:50'],
            'fechaVencimientoLicencia' => ['required', 'date'],

        ]);

        $data = new Empleado();
        if ($request["canton"] != 'Seleccione su Cantón') {
            $data->canton = $request["canton"];
        } else {
            $data->canton = "";
        }

        if ($request["distrito"] != 'Seleccione su Distrito') {
            $data->distrito = $request["distrito"];
        } else {
            $data->distrito = "";
        }
        $data->nombre = $request["nombre"];
        $data->apellido1 = $request["apellido1"];
        $data->apellido2 = $request["apellido2"];
        $data->tipoCedula = $request["tipoCedula"];
        $data->numeroCedula = $request["numeroCedula"];
        $data->otrasReferencias = $request["otrasReferencias"];
        $data->sexo = $request["sexo"];
        $data->numeroTelefono = $request["numeroTelefono"];
        $data->email = $request["email"];
        $data->observaciones = $request["observaciones"];
        $data->estado = 'Activo';
        $data->id_trailer = $request["id_trailer"];
        $data->provincia = $request["provincia"];
        $data->tipoLicencia = $request["tipoLicencia"];
        $data->fechaVencimientoLicencia = $request["fechaVencimientoLicencia"];
        $data->fechaNacimiento = $request["fechaNacimiento"];

        $data->save();

        return redirect()->back()->with("success", 'Dato guardado satisfactoriamente.');
    }


    public function edit($id)
    {
        $item = Empleado::findOrFail($id);

        $respuesta =  Http::get('https://ubicaciones.paginasweb.cr/provincias.json');
        $respuestaProvincia = $respuesta->json();
        $trailers = Trailer::select('*')->get();
        return view('empleados.editarEmpleados', compact('item', 'respuestaProvincia', 'trailers'));
    }


    public function update(Request $request, $id)
    {
        $item = Empleado::findOrFail($id);

        $request->validate([
         
            'nombre' => ['required', 'string', 'min:4','max:30'],
            'apellido1' => ['required','string', 'min:4', 'max:30'],
            'apellido2' => ['nullable', 'string', 'max:30'],
            'fechaNacimiento' => ['nullable', 'date'],
            'observaciones' => ['nullable', 'string', 'max:100'],
            'provincia' => ['nullable', 'string'],
            'canton' => ['nullable', 'string'],
            'distrito' => ['nullable', 'string'],
            'otrasReferencias' => ['nullable', 'string', 'max:100'],     
            'tipoCedula' => ['required'],
            'numeroCedula' => [
                'required', 'string',
                Rule::unique('empleados')->ignore($item->id_empleado, 'id_empleado'), 'min:9', 'max:30'
            ],
            'email' => [
                'nullable', 'string',
                Rule::unique('empleados')->ignore($item->id_empleado, 'id_empleado'), 'email', 'max:30'
            ],
            'numeroTelefono' => ['required', 'string', 'digits_between:8,20'],
            'id_trailer' => ['required', 'exists:trailers,id_trailer'],
            'tipoLicencia' => ['required'],
            'fechaVencimientoLicencia' => ['required', 'date'],

            'sexo' => ['required'],
        ]);




        if (($request["provincia"]) == ($item->provincia) || $request["provincia"] == "") {
            $item->provincia = $item->provincia;
        } else {
            $item->provincia = $request["provincia"];
        }

        if (($request["canton"]) == ($item->canton) || $request["canton"] == "") {
            $item->canton = $item->canton;
        } else {
            $item->canton = $request["canton"];
        }

        if ($request["distrito"] == ($item->distrito) || $request["distrito"] == "") {
            $item->distrito = $item->distrito;
        } else {
            $item->distrito = $request["distrito"];
        }

        $item->nombre = $request["nombre"];
        $item->apellido1 = $request["apellido1"];
        $item->apellido2 = $request["apellido2"];
        $item->tipoCedula = $request["tipoCedula"];
        $item->otrasReferencias = $request["otrasReferencias"];
        $item->sexo = $request["sexo"];
        $item->numeroTelefono = $request["numeroTelefono"];
        $item->email = $request["email"];
        $item->observaciones = $request["observaciones"];
        $item->numeroCedula = $request["numeroCedula"];
        $item->id_trailer = $request["id_trailer"];
        $item->tipoLicencia = $request["tipoLicencia"];
        $item->fechaVencimientoLicencia = $request["fechaVencimientoLicencia"];
        $item->fechaNacimiento = $request["fechaNacimiento"];
        $item->update();
       
        return redirect()->back()->with("success", 'Empleado editado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $item = Empleado::findOrFail($id);

        $item->delete();

        return redirect()->back()->with("success", 'Empleado eliminado satisfactoriamente.');
    }

    public function buscar(Request $request)
    {

        $numeroCedula = $request['buscar'];

        $data = Empleado::where('numeroCedula', 'like', "%$numeroCedula%")->where('id_empleado', '>', 1)->paginate(8);

        $data2 = [];

        foreach ($data as $item) {
            if ($item->canton == null) {
                $item->canton == "";
            }

            if ($item->provincia == null) {
                $item->provincia == "";
            }
            if ($item->id_trailer == null) {
                // dd($item->id_trailer);

                $placa = "";
            } else {
                $placa = $item->trailer->placaTrailer;
            }
            $data2[] = [
                "id_empleado" => $item->id_empleado,
                "cedula" => $item->numeroCedula,
                "nombre" => $item->nombre,
                "apellido1" => $item->apellido1,
                "apellido2" => $item->apellido2,
                "estado" => $item->estado,
                "email" => $item->email,
                "numeroTelefono" => $item->numeroTelefono,
                "observaciones" => $item->observaciones,
                "direccion" => $item->provincia . ', ' . $item->canton . ', ' . $item->distrito,
                "placaTrailer" => $placa
            ];
        }

        return response()->json($data2);
    }


    public function reporteEmpleados()
    {
        $data = Empleado::latest()->where('id_empleado', '>', 1)->paginate(8);

        return view('reportes.reporteEmpleado', compact('data'));
    }

    public function reporteEmpleadosLicencia()
    {  // A vencer en 30 días
        $fecha1 = now()->toDateString();

        $fecha2 = now()->addDays(90)->toDateString();

        $data = Empleado::whereBetween('fechaVencimientoLicencia', [$fecha1, $fecha2])->paginate(8);

        //Vencidas

        $fecha3 = now()->subDays(30)->toDateString();

        $data2 = Empleado::whereBetween('fechaVencimientoLicencia', [$fecha3, $fecha1])->paginate(8);
        return view('reportes.reporteEmpleadoLicencia', compact('data', 'data2'));
    }



    public function reporteViajesEmpleado($id)
    {

        $data = Viajes::where('id_empleado', $id)->paginate(8);
        $nombre = Empleado::select('nombre')->where('id_empleado', $id)->get();
        $id = Empleado::select('id_empleado')->where('id_empleado', $id)->get();
        return view('viajes.viajesEmpleado', compact('data', 'nombre', 'id'));
    }

    public function PDF()
    {
        //$pdf = new PDF();
        $data = Empleado::latest()->where('id_empleado', '>', 1)->get();

        $pdf = PDF::loadView('reportes.pdfEmpleado', compact('data'));
        return   $pdf->download('Reporte de Empleados.pdf');
    }

    public function PDFViajes($id)
    {
        //$pdf = new PDF();
        $data = Viajes::where('id_empleado', $id)->get();
        $nombre = Empleado::select('nombre')->where('id_empleado', $id)->get();
        $pdf = PDF::loadView('reportes.pdfViajesEmpleado', compact('data', 'nombre'));
        return   $pdf->download('Viajes del Empleado.pdf');
    }

    public function Excel()
    {

        $data = Empleado::latest()->where('id_empleado', '>', 1)->get();

        return Excel::download(new EmpleadoExport, 'Reporte de Empleados.xlsx');
    }
}
