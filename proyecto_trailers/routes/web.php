<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RutaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReparacionesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TrailerController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ViajesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('sesion.inicioSesion');
});



Route::get('prueba', [Controller::class, 'prueba'])->name('prueba');

Route::get('navbar/navbar', [Controller::class, 'navbar'])->name('navbar')->middleware('verified','auth');


Route::group(
    [
        'middleware' => 'adminRoutes',
    ],
    function () {
        //Bitácora

        Route::get('reportes/bitacora/PDF', [HomeController::class, 'PDF'])->name('imprimirBitacora')->middleware('verified','auth');
        Route::post('bitacora/fecha', [HomeController::class, 'buscarFechaBitacora'])->name('bitacora.fecha')->middleware('verified','auth');

        //Usuarios
        Route::get('usuarios/ingresarUsuarios', [UsuarioController::class, 'create'])->name('ingresarUsuario')->middleware('verified','auth');

        Route::post('usuarios/storeUsuario', [UsuarioController::class, 'ingresarUsuario'])->name('usuario.store')->middleware('verified','auth');

        Route::get('usuarios/edit/{id}', [UsuarioController::class, 'edit'])->name('usuario.edit')->middleware('verified','auth');

        Route::post('usuarios/update/{id}', [UsuarioController::class, 'update'])->name('usuario.update')->middleware('verified','auth');

        Route::post('usuarios/verUsuarios', [UsuarioController::class, 'buscar'])->middleware('verified','auth');

        Route::get('usuarios/delete/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('verified','auth');

        Route::post('usuarios/delete/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy')->middleware('verified','auth');

        //Empleados

        Route::get('empleados/ingresarEmpleados', [EmpleadoController::class, 'apiProvincia'])->name('ingresarEmpleados')->middleware('verified','auth');

        Route::get('empleados/editarEmpleados', [EmpleadoController::class, 'apiProvinciaModificar'])->name('editarEmpleados')->middleware('verified','auth');

        Route::post('empleados/storeEmpleado', [EmpleadoController::class, 'ingresarEmpleado'])->name('empleado.store')->middleware('verified','auth');

        Route::get('empleados/delete/{id}', [EmpleadoController::class, 'destroy'])->name('empleado.destroy')->middleware('verified','auth');

        Route::post('empleados/delete/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy')->middleware('verified','auth');

        Route::get('empleados/edit/{id}', [EmpleadoController::class, 'edit'])->name('empleado.edit')->middleware('verified','auth');

        Route::post('empleados/update/{id}', [EmpleadoController::class, 'update'])->name('empleados.update')->middleware('verified','auth');

        //Reparaciones

        Route::get('reparaciones/ingresarReparaciones', [ReparacionesController::class, 'comboTrailers'])->name('ingresarReparaciones')->middleware('verified','auth');

        Route::post('reparaciones/storeReparacion', [ReparacionesController::class, 'ingresarReparacion'])->name('reparaciones.store')->middleware('verified','auth');

        Route::get('reparaciones/delete/{id}', [ReparacionesController::class, 'destroy'])->name('reparaciones.destroy')->middleware('verified','auth');

        Route::post('reparaciones/delete/{id}', [ReparacionesController::class, 'destroy'])->name('reparaciones.destroy')->middleware('verified','auth');

        Route::get('reparaciones/edit/{id}', [ReparacionesController::class, 'edit'])->name('reparaciones.edit')->middleware('verified','auth');

        Route::post('reparaciones/update/{id}', [ReparacionesController::class, 'update'])->name('reparaciones.update')->middleware('verified','auth');


        //Rutas

        Route::post('rutas/storeRuta', [RutaController::class, 'ingresarRuta'])->name('ruta.store')->middleware('verified','auth');

        Route::get('rutas/delete/{id}', [RutaController::class, 'destroy'])->name('ruta.destroy')->middleware('verified','auth');

        Route::post('rutas/delete/{id}', [RutaController::class, 'destroy'])->name('rutas.destroy')->middleware('verified','auth');

        Route::get('rutas/edit/{id}', [RutaController::class, 'edit'])->name('ruta.edit')->middleware('verified','auth');

        Route::put('rutas/update/{id}', [RutaController::class, 'update'])->name('ruta.update')->middleware('verified','auth');

        Route::get('rutas/ingresarRutas', [Controller::class, 'ingresarRutas'])->name('ingresarRutas')->middleware('verified','auth');

        //Trailers

        Route::post('trailers/storeTrailer', [TrailerController::class, 'ingresarTrailer'])->name('trailers.store')->middleware('verified','auth');

        Route::get('trailers/delete/{id}', [TrailerController::class, 'destroy'])->name('trailers.destroy')->middleware('verified','auth');

        Route::post('trailers/delete/{id}', [TrailerController::class, 'destroy'])->name('trailer.destroy')->middleware('verified','auth');

        Route::get('trailers/edit/{id}', [TrailerController::class, 'edit'])->name('trailers.edit')->middleware('verified','auth');

        Route::post('trailers/update/{id}', [TrailerController::class, 'update'])->name('trailers.update')->middleware('verified','auth');

        Route::get('trailers/ingresarTrailers', [Controller::class, 'ingresarTrailers'])->name('ingresarTrailers')->middleware('verified','auth');

        //Viajes
        //Route::get('reportes/reporteViajes', [ViajesController::class, 'buscarFecha'])->middleware('auth');

        Route::post('viajes/fecha', [ViajesController::class, 'buscarFecha'])->name('viajes.fecha')->middleware('verified','auth');

        Route::get('viajes/create', [ViajesController::class, 'create'])->name('viajes.create')->middleware('verified','auth');

        Route::post('viajes/storeViaje', [ViajesController::class, 'ingresarViaje'])->name('viajes.store')->middleware('verified','auth');

        Route::get('viajes/delete/{id}', [ViajesController::class, 'destroy'])->name('viajes.destroy')->middleware('verified','auth');

        Route::post('viajes/delete/{id}', [ViajesController::class, 'destroy'])->name('viaje.destroy')->middleware('verified','auth');

        Route::get('viajes/edit/{id}', [ViajesController::class, 'edit'])->name('viajes.edit')->middleware('verified','auth');

        Route::post('viajes/update/{id}', [ViajesController::class, 'update'])->name('viajes.update')->middleware('verified','auth');

        //Usuarios
       

        Route::get('usuarios/verUsuarios', [UsuarioController::class, 'index'])->name('verUsuarios')->middleware('verified','auth');

         }
);



//Reportes


Route::get('reportes/reporteTrailers', [TrailerController::class, 'reporteTrailers'])->name('reporteTrailers')->middleware('verified','auth');

Route::get('reportes/reporteViajes', [ViajesController::class, 'reporteViajes'])->name('reporteViajes')->middleware('verified','auth');

Route::get('reportes/reporteRutas', [RutaController::class, 'reporteRutas'])->name('reporteRutas')->middleware('verified','auth');

Route::get('reportes/reporteReparaciones', [ReparacionesController::class, 'reporteReparaciones'])->name('reporteReparaciones')->middleware('verified','auth');

Route::get('reportes/bitacora', [HomeController::class, 'reporteBitacora'])->name('reporteBitacora')->middleware('verified','auth');


//Empleados


Route::get('empleados/verEmpleados', [EmpleadoController::class, 'index'])->name('verEmpleados')->middleware('verified','auth');

Route::get('reportes/reporteEmpleados', [EmpleadoController::class, 'reporteEmpleados'])->name('reporteEmpleados')->middleware('verified','auth');

Route::get('reportes/reporteEmpleadoLicencia', [EmpleadoController::class, 'reporteEmpleadosLicencia'])->name('reporteEmpleadosLicencia')->middleware('verified','auth');

Route::post('empleados/verEmpleados', [EmpleadoController::class, 'buscar'])->middleware('verified','auth');

Route::get('reportes/reporteEmpleados/PDF', [EmpleadoController::class, 'PDF'])->name('imprimir')->middleware('verified','auth');

Route::post('provincia/select', [EmpleadoController::class, 'apiCanton'])->middleware('auth');

Route::post('canton/select/api', [EmpleadoController::class, 'apiDistrito'])->middleware('auth');

Route::get('viajes/viajesEmpleado/{id}', [EmpleadoController::class, 'reporteViajesEmpleado'])->name('empleado.viajes')->middleware('verified','auth');

Route::get('viajes/viajesEmpleado/PDF/{id}', [EmpleadoController::class, 'PDFViajes'])->name('imprimirViajesEmpleado')->middleware('verified','auth');

Route::get('reportes/reporteEmpleado/Excel', [EmpleadoController::class, 'Excel'])->name('excelEmpleados')->middleware('verified','auth');

//Rutas


Route::get('rutas/verRutas', [RutaController::class, 'index'])->name('verRutas')->middleware('verified','auth');

Route::post('rutas/verRutas', [RutaController::class, 'buscar'])->middleware('auth')->middleware('verified','verified');

Route::get('reportes/reporteRutas/PDF', [RutaController::class, 'PDF'])->name('imprimirRutas')->middleware('verified','auth');

Route::get('reportes/reporteRutas/Excel', [RutaController::class, 'Excel'])->name('excelRutas')->middleware('verified','auth');


//Trailers


Route::get('trailers/verTrailers', [TrailerController::class, 'index'])->name('verTrailers')->middleware('verified','auth');

Route::post('trailers/verTrailers', [TrailerController::class, 'buscar'])->middleware('verified','auth');

Route::get('trailers/reporteTrailer/PDF', [TrailerController::class, 'PDF'])->name('imprimirTrailers')->middleware('verified','auth');

Route::get('trailers/reporteTrailer/Excel', [TrailerController::class, 'Excel'])->name('excelTrailers')->middleware('verified','auth');


//Viajes


Route::get('viajes/verViajes', [ViajesController::class, 'index'])->name('verViajes')->middleware('verified','auth');

Route::post('viajes/verViajes', [ViajesController::class, 'buscar'])->middleware('verified','auth');

Route::get('viajes/reporteViajes/PDF', [ViajesController::class, 'PDF'])->name('imprimirViajes')->middleware('verified','auth');

Route::get('viajes/reporteViajes/Excel', [ViajesController::class, 'Excel'])->name('excelViajes')->middleware('verified','auth');


//Reparaciones


Route::get('reparaciones/verReparaciones', [ReparacionesController::class, 'index'])->name('verReparaciones')->middleware('verified','auth');

Route::post('reparaciones/verReparaciones', [ReparacionesController::class, 'buscar'])->middleware('verified','auth');

Route::get('reparaciones/reporteReparaciones/PDF', [ReparacionesController::class, 'PDF'])->name('imprimirReparaciones')->middleware('verified','auth');

Route::get('reportes/reporteReparaciones/Excel', [ReparacionesController::class, 'Excel'])->name('excelReparaciones')->middleware('verified','auth');


//Autenticación


Route::get('sesion/inicioSesion', [Controller::class, 'inicioSesion'])->name('inicioSesion');

Route::get('sesion/registro', [Controller::class, 'registro'])->name('registro');



//Graficas


Route::get('graficas/graficaRutas', [Controller::class, 'graficaRutas'])->name('graficaRutas')->middleware('verified','auth');

Route::get('graficos/graficoViajes', [Controller::class, 'graficoViajes']);

Route::get('graficos/graficoReparaciones', [Controller::class, 'graficoReparaciones'])->name('graficoReparaciones')->middleware('verified','auth');

Route::get('graficos/graficoRutas', [Controller::class, 'graficoRutas'])->name('graficoRutas')->middleware('verified','auth');



//Otros

Route::get('grafic/Viajes', function(){
    return view('graficos.graficoViajes');
});

Route::get('inicio', [Controller::class, 'index']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified','auth');

Route::get('/usuarios/miPerfil', [UsuarioController::class, 'miPerfil'])->name('miPerfil')->middleware('verified','auth');

Route::post('usuarios/updateMiPerfil/{id}', [UsuarioController::class, 'updateMiPerfil'])->name('usuario.updateMiPerfil')->middleware('verified','auth');

Route::get('/report/rutas', [ReportController::class, 'rutasReport']);

Route::post('/report/viajes', [ReportController::class, 'reportViajes']);

Route::get('/report/reparaciones', [ReportController::class, 'reporteReparaciones']);

//Email Verificación

//Route::get('/auth/verify', [Controller::class, 'verify1']);

Route::get('/sesion/verify', [Controller::class, 'verifyCorreo']);
