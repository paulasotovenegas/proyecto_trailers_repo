<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('Roles', function (Blueprint $table) {
            $table->bigIncrements('id_rol')->unique();
            $table->string('descripcionRol', 150);

            $table->timestamps();
            
        });


        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('id_rol');

            $table->foreign('id_rol')->references('id_rol')->on('Roles');

            $table->timestamps();
        });


        Schema::create('Trailers', function (Blueprint $table) {
            $table->bigIncrements('id_trailer')->unique();
            $table->string('placaTrailer', 45)->unique();
            $table->date('tarjetaPesosDimensiones');
            $table->date('riteve');
            $table->date('marchamo');
            $table->date('tarjetaTransportePeligroso');
            $table->string('codigoTransportista', 30)->nullable();
            $table->string('estado', 50);
            $table->timestamps();
        });

        Schema::create('Rutas', function (Blueprint $table) {
            $table->bigIncrements('id_ruta')->unique();
            $table->string('descripcionRuta', 150);

            $table->timestamps();
        });

        Schema::create('Empleados', function (Blueprint $table) {
            $table->bigIncrements('id_empleado')->unique();
            $table->string('numeroCedula', 45)->unique();
            $table->string('nombre', 50);
            $table->string('apellido1', 50);
            $table->string('apellido2', 50)->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->string('tipoCedula', 50);
            $table->string('sexo', 50);
            $table->string('observaciones', 150)->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('estado', 50);
            $table->string('provincia', 50)->nullable();
            $table->string('canton', 50)->nullable();
            $table->string('distrito', 50)->nullable();
            $table->string('otrasReferencias', 200)->nullable();
            $table->string('tipoLicencia', 50);
            $table->date('fechaVencimientoLicencia');
            $table->string('numeroTelefono', 20)->nullable();
            $table->unsignedBigInteger('id_trailer')->nullable();



            $table->foreign('id_trailer')->references('id_trailer')->on('Trailers')->onDelete('set null');


            $table->timestamps();
        });

        Schema::create('Viajes', function (Blueprint $table) {
            $table->bigIncrements('id_viaje')->unique();
            $table->dateTime('fechaHoraLlegada');
            $table->dateTime('fechaHoraSalida')->nullable();
            $table->time('tiempoDescarga')->nullable();
            $table->double('peajes', 10, 2)->nullable();
            $table->double('diesel', 10, 2)->nullable();
            $table->double('gananciaBruta', 10, 2);
            $table->double('pagoEmpleado', 10, 2)->nullable();
            $table->string('descripcionViaje', 150);
            $table->string('descripcionCarga', 150);
            $table->double('gananciaNeta', 10, 2)->nullable();
            $table->unsignedBigInteger('id_trailer')->nullable();
            $table->unsignedBigInteger('id_ruta')->nullable();
            $table->unsignedBigInteger('id_empleado')->nullable();


            $table->foreign('id_trailer')->references('id_trailer')->on('Trailers')->onDelete('set null');
            $table->foreign('id_ruta')->references('id_ruta')->on('Rutas')->onDelete('set null');
            $table->foreign('id_empleado')->references('id_empleado')->on('Empleados')->onDelete('set null');

            $table->timestamps();
        });

        Schema::create('Reparaciones', function (Blueprint $table) {
            $table->bigIncrements('id_reparacion')->unique();
            $table->string('descripcionReparacion', 150);
            $table->date('fechaReparacion');
            $table->date('fechaDano')->nullable();
            $table->string('observaciones', 150)->nullable();
            $table->double('costo', 10, 2)->nullable();
            $table->string('duracion', 50)->nullable();
            $table->unsignedBigInteger('id_trailer')->nullable();


            $table->foreign('id_trailer')->references('id_trailer')->on('Trailers')->onDelete('set null');


            $table->timestamps();
        });

        Schema::create('Bitacora', function (Blueprint $table) {
            $table->bigIncrements('id_bitacora')->unique();
            $table->date('fecha');
            $table->string('accion', 50);
            $table->string('usuario', 30);

           

            $table->timestamps();
        });



    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('Trailers');
        Schema::dropIfExists('Empleados');
        Schema::dropIfExists('Viajes');
        Schema::dropIfExists('Rutas');
        Schema::dropIfExists('Reparaciones');
        Schema::dropIfExists('Bitacora');
    }
}
