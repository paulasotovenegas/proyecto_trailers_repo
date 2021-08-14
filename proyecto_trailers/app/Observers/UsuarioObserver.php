<?php

namespace App\Observers;
use App\Models\Bitacora;
use App\Models\User;


class UsuarioObserver
{
    /**
     * Handle the Usuario "created" event.
     *
     * @param  \App\Models\User  $usuario
     * @return void
     */
    public function created(User $usuario)
    {
       
    }

    /**
     * Handle the Usuario "updated" event.
     *
     * @param  \App\Models\User  $usuario
     * @return void
     */
    public function updated(User $usuario)
    {

    }

    /**
     * Handle the Usuario "deleted" event.
     *
     * @param  \App\Models\User  $usuario
     * @return void
     */
    public function deleted(User $usuario)
    {
        $log= new Bitacora();
        $log->accion = "Eliminación de Usuario";
        $log->fecha = Now();
        $log->usuario = auth()->user()->email;

        $log->save();
    }

    /**
     * Handle the Usuario "restored" event.
     *
     * @param  \App\Models\User  $usuario
     * @return void
     */
    public function restored(User $usuario)
    {
        //
    }

    /**
     * Handle the Usuario "force deleted" event.
     *
     * @param  \App\Models\User  $usuario
     * @return void
     */
    public function forceDeleted(User $usuario)
    {
        //
    }
}
