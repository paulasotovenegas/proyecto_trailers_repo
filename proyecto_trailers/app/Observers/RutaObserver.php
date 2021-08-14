<?php

namespace App\Observers;
use App\Models\Bitacora;
use App\Models\Ruta;

class RutaObserver
{
    /**
     * Handle the Ruta "created" event.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return void
     */
    public function created(Ruta $ruta)
    {
        $log= new Bitacora();
        $log->accion = "Creación de Ruta";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Ruta "updated" event.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return void
     */
    public function updated(Ruta $ruta)
    {
        $log= new Bitacora();
        $log->accion = "Actualización de Ruta";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Ruta "deleted" event.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return void
     */
    public function deleted(Ruta $ruta)
    {
        $log= new Bitacora();
        $log->accion = "Eliminación de Ruta";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Ruta "restored" event.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return void
     */
    public function restored(Ruta $ruta)
    {
        //
    }

    /**
     * Handle the Ruta "force deleted" event.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return void
     */
    public function forceDeleted(Ruta $ruta)
    {
        //
    }
}
