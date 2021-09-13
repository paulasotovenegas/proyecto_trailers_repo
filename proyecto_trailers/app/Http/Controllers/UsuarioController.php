<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


class UsuarioController extends Controller
{
    public function index()
    {
        $data = User::latest()->where('id', '!=', auth()->user()->id)->paginate(8);

        return view('usuarios.verUsuarios', compact('data'));
    }



    public function create()
    {
        $roles = Rol::select('*')->get();

        return view('usuarios.ingresarUsuarios', compact('roles'));
    }

    public function ingresarUsuario(Request $request)
    {
        $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->uncompromised(), 'string', 'confirmed'],
            'id_rol' => ['required', 'string']


        ]);

        $data = new User();

        $data->name = $request["name"];
        $data->email = $request["email"];
        $data->password = Hash::make($request["password"]);
        $data->id_rol = $request["id_rol"];


        $data->save();


        return redirect()->back()->with("success", 'Dato guardado satisfactoriamente.');
    }


    public function buscar(Request $request)
    {

        $email = $request['buscar'];

        $data = User::where('email', 'like', "%$email%")->where('id', '!=', auth()->user()->id)->paginate(8);

        $data2 = [];

        foreach ($data as $item) {

            $rol = $item->rol->descripcionRol;

            $data2[] = [
                "id" => $item->id,
                "email" => $item->email,
                "name" => $item->name,
                "rol" => $rol
            ];
        }

        return response()->json($data2);
    }



    public function edit($id)
    {
        $item = User::findOrFail($id);
        $roles = Rol::select('*')->get();
        return view('usuarios.editarUsuarios', compact('item', 'roles'));
    }

    public function miPerfil()
    {
        $id = auth()->id();
        $item = User::findOrFail($id);
        $roles = Rol::select('*')->get();
        return view('usuarios.miPerfil', compact('item', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        if ((trim($request->email) == ($item->email))) {
            $request->validate([

                'name' => ['required', 'string', 'max:255'],
                'id_rol' => ['required', 'string']



            ]);

            $item->name  = $request["name"];
            $item->id_rol = $request["id_rol"];
        }

        $item->update();
        return redirect()->back()->with("success", 'Editado Satisfactoriamente.');
    }

    public function updateMiPerfil(Request $request, $id)
    {

        $request->validate([

            'name' => ['required', 'string', 'max:255'],




        ]);
        $item = User::findOrFail($id);

        $item->name = $request->name;
        $item->update();
        return redirect()->back()->with("success", 'Usuario Editado Satisfactoriamente.');
    }



    public function destroy($id)
    {
        $item = User::findOrFail($id);

        $item->delete();

        return redirect()->back()->with("success", 'Usuario Eliminado Satisfactoriamente.');
    }
}
