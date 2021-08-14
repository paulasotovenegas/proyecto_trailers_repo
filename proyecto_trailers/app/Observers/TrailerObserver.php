<?php

namespace App\Observers;
use App\Models\Bitacora;
use App\Models\Trailer;

class TrailerObserver
{
    /**
     * Handle the Trailer "created" event.
     *
     * @param  \App\Models\Trailer  $trailer
     * @return void
     */
    public function created(Trailer $trailer)
    {
        $log= new Bitacora();
        $log->accion = "Creación de Trailer";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Trailer "updated" event.
     *
     * @param  \App\Models\Trailer  $trailer
     * @return void
     */
    public function updated(Trailer $trailer)
    {
        $log= new Bitacora();
        $log->accion = "Actualización de Trailer";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Trailer "deleted" event.
     *
     * @param  \App\Models\Trailer  $trailer
     * @return void
     */
    public function deleted(Trailer $trailer)
    {
        $log= new Bitacora();
        $log->accion = "Eliminación de Trailer";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Trailer "restored" event.
     *
     * @param  \App\Models\Trailer  $trailer
     * @return void
     */
    public function restored(Trailer $trailer)
    {
        //
    }

    /**
     * Handle the Trailer "force deleted" event.
     *
     * @param  \App\Models\Trailer  $trailer
     * @return void
     */
    public function forceDeleted(Trailer $trailer)
    {
        //
    }
}
