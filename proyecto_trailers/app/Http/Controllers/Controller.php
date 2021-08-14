<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  
    public function navbar(){
        return view('navbar/navbar');
    }

    public function prueba(){
        return view('prueba');
    }

    /*
    public function verify1(){
        return view('auth/verify');
    }   }*/
    public function verifyCorreo(){
        return view('sesion/verify');
    }

    public function reporteTrailers(){
        return view('reportes/reporteTrailer');
    }

    public function reporteViajes(){
        return view('reportes/reporteViajes');
    }

    public function reporteRutas(){
        return view('reportes/reporteRutas');
    }

    public function reporteReparaciones(){
        return view('reportes/reporteReparaciones');
    }

    public function ingresarEmpleados(){
        return view('empleados/ingresarEmpleados');
    }
    
    public function verViajes(){
        return view('viajes/verViajes');
    }

    public function ingresarViajes(){
        return view('viajes/ingresarViajes');
    }

    public function ingresarRutas(){
        return view('rutas/ingresarRutas');
    }

    public function ingresarUsuarios(){
        return view('usuarios/ingresarUsuarios');
    }

    public function verRutas(){
        return view('rutas/verRutas');
    }

    public function verReparaciones(){
        return view('reparaciones/verReparaciones');
    }

    public function ingresarReparaciones(){
        return view('reparaciones/ingresarReparaciones');
    }

    public function verTrailers(){
        return view('trailers/verTrailers');
    }

    public function ingresarTrailers(){
        return view('trailers/ingresarTrailers');
    }

    public function inicioSesion(){
        return view('sesion/inicioSesion');
    }

    public function registro(){
        return view('sesion/registro');
    }

    public function bitacora(){
        return view('reportes/bitacora');
    }

    public function graficaRutas(){
        return view('graficas/graficaRutas');
    }
    
    public function verUsuarios(){
        return view('usuarios/verUsuarios');
    }

    public function graficoViajes(){
        return view('graficos/graficoViajes');
    }

    public function graficoReparaciones(){
        return view('graficos/graficoReparaciones');
    }

    public function graficoRutas(){
        return view('graficos/graficoRutas');
    }
    
}
