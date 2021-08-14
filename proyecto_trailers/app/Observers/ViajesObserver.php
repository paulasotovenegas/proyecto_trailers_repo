<?php

namespace App\Observers;
use App\Models\Bitacora;
use App\Models\Viajes;

class ViajesObserver
{
    /**
     * Handle the Viajes "created" event.
     *
     * @param  \App\Models\Viajes  $viajes
     * @return void
     */
    public function created(Viajes $viajes)
    {
        $log= new Bitacora();
        $log->accion = "Creación de Viaje";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Viajes "updated" event.
     *
     * @param  \App\Models\Viajes  $viajes
     * @return void
     */
    public function updated(Viajes $viajes)
    {
        $log= new Bitacora();
        $log->accion = "Actualización de Viaje";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Viajes "deleted" event.
     *
     * @param  \App\Models\Viajes  $viajes
     * @return void
     */
    public function deleted(Viajes $viajes)
    {
        $log= new Bitacora();
        $log->accion = "Eliminación de Viaje";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Viajes "restored" event.
     *
     * @param  \App\Models\Viajes  $viajes
     * @return void
     */
    public function restored(Viajes $viajes)
    {
        //
    }

    /**
     * Handle the Viajes "force deleted" event.
     *
     * @param  \App\Models\Viajes  $viajes
     * @return void
     */
    public function forceDeleted(Viajes $viajes)
    {
        //
    }
}
