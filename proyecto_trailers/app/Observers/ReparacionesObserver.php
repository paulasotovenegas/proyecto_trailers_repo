<?php

namespace App\Observers;
use App\Models\Bitacora;
use App\Models\Reparaciones;

class ReparacionesObserver
{
    /**
     * Handle the Reparaciones "created" event.
     *
     * @param  \App\Models\Reparaciones  $reparaciones
     * @return void
     */
    public function created(Reparaciones $reparaciones)
    {
        $log= new Bitacora();
        $log->accion = "Creación de Reparación";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Reparaciones "updated" event.
     *
     * @param  \App\Models\Reparaciones  $reparaciones
     * @return void
     */
    public function updated(Reparaciones $reparaciones)
    {
        $log= new Bitacora();
        $log->accion = "Actualización de Reparación";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Reparaciones "deleted" event.
     *
     * @param  \App\Models\Reparaciones  $reparaciones
     * @return void
     */
    public function deleted(Reparaciones $reparaciones)
    {
        $log= new Bitacora();
        $log->accion = "Eliminación de Reparación";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Reparaciones "restored" event.
     *
     * @param  \App\Models\Reparaciones  $reparaciones
     * @return void
     */
    public function restored(Reparaciones $reparaciones)
    {
        //
    }

    /**
     * Handle the Reparaciones "force deleted" event.
     *
     * @param  \App\Models\Reparaciones  $reparaciones
     * @return void
     */
    public function forceDeleted(Reparaciones $reparaciones)
    {
        //
    }
}
