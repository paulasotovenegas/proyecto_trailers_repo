<?php

namespace App\Providers;

use App\Observers\EmpleadoObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Empleado;
use App\Models\Ruta;
use App\Models\Reparaciones;
use App\Models\Trailer;
use App\Models\User;
use App\Models\Viajes;
use App\Observers\ReparacionesObserver;
use App\Observers\RutaObserver;
use App\Observers\TrailerObserver;
use App\Observers\UsuarioObserver;
use App\Observers\ViajesObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Empleado::observe(EmpleadoObserver::class);
        Ruta::observe(RutaObserver::class);
        Trailer::observe(TrailerObserver::class);
        Reparaciones::observe(ReparacionesObserver::class);
        User::observe(UsuarioObserver::class);
        Viajes::observe(ViajesObserver::class);

    }
}
