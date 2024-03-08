<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;



class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {
        // MODIFICAR EL REQUEST
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required','unique:users,email,'.auth()->user()->id,'email','max:60'],
            'password' => 'required|min:4',
            'nueva_password' => 'required|min:4',

        ]);

        // VALIDAR CLAVE ANTERIOR
        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->with('mensaje', 'Credenciales Anterior Incorrectas');
        }

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->password = $request->nueva_password;
        $usuario->save();


        return redirect()->route('posts.index', $usuario->username);
    }
}
