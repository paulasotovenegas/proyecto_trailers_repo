<?php

namespace App\Observers;

use App\Models\Bitacora;
use App\Models\Empleado;

class EmpleadoObserver
{
    /**
     * Handle the Empleado "created" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function created(Empleado $empleado)
    {
        $log= new Bitacora();
        $log->accion = "Creación de Empleado";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Empleado "updated" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function updated(Empleado $empleado)
    {
        $log= new Bitacora();
        $log->accion = "Actualización de Empleado";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Empleado "deleted" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function deleted(Empleado $empleado)
    {
        $log= new Bitacora();
        $log->accion = "Eliminación de Empleado";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Empleado "restored" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function restored(Empleado $empleado)
    {
        //
    }

    /**
     * Handle the Empleado "force deleted" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function forceDeleted(Empleado $empleado)
    {
        //
    }
}
