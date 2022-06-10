<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController extends Controller
{

    protected $usuarioModel;

    public function __construct(User $usuario)
    {
        $this->usuarioModel = $usuario;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mensaje = "", $tipo = "")
    {
        $usuarios = $this->usuarioModel->obtenerUsuarios();
        return view('pages.admin.usuarios', ["usuarios" => $usuarios]);
    }

    /**
     * Muestra un formulario para crear un nuevo usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.admin.usuarioform", ["mode" => "create"]);
    }

    /**
     * Almacena un usuario con los datos recibidos de un formulario y muestra el listado de usuarios
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $usuario = new User($request->all());
        if (Hash::needsRehash($usuario->password)) {
            $usuario->password = Hash::make($usuario->password);
        }

        //el usuario se genera como no borrado
        $usuario->borrado = false;
        //token para el acceso desde app
        $usuario->react_token = Str::random(10);

        

        if ($request->hasFile('avatar')) {

            $archivo = $request->file('avatar')->store('');
            //se reemplazan las / por \ para que no haya error
            $archivo = str_replace('/', '\\', $archivo);
            $usuario->avatar = $archivo;
            //$avatar = $request->file('avatar');
            // $filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Image::make($avatar)->resize(300, 300)->save( storage_path('/uploads/' . $filename ));
            // $usuario->avatar = $filename;
        }

        try {

            $usuario->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha creado un cliente en la base de datos', ['usuario' => $usuario]);
            session(['succ1' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado crear un usuario en la base de datos y ha recibido un error fatal', ['error' => $usuario]);
            session(['error1' => '']);
        }
        return redirect()->action([UserController::class, 'index']);
    }

    /**
     * Muestra los datos del usuario
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = $this->usuarioModel->obtenerUsuario($id);
        return view("pages.admin.usuarioform", ["usuario" => $usuario, "id_usuario" => $id, "mode" => "show"]);
    }

    /**
     * Muestra un formulario con los datos del usuario para su edición
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtenemos todos los datos del usuario que tenga la id que hemos pasado por parametro
        $usuario = $this->usuarioModel->obtenerUsuario($id);
        //Devolvemos la vista pasandole una serie de parametros
        return view("pages.admin.usuarioform", ["usuario" => $usuario, "id_usuario" => $id, "mode" => "edit"]);
    }

    /**
     * Actualiza un usuario a partir de su id y muestra el listado de usuarios
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  number  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Buscamos el usuario por id
        $usuario = User::find($id);
        //Rellenamos el usuario con los datos que nos vengan de la request
        $usuario->fill($request->all());

        if (Hash::needsRehash($usuario->password)) {
            $usuario->password = Hash::make($usuario->password);
        }

        if ($request->hasFile('avatar')) {
            $archivo = $request->file('avatar')->store('');
            //se reemplazan las / por \ para que no haya error
            $archivo = str_replace('/', '\\', $archivo);
            $usuario->avatar = $archivo;
        }

        //Guardamos los datos
        try {
            $usuario->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado un usuario en la base de datos', ['usuario' => $usuario]);
            session(['succ2' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar un usuario en la base de datos y ha recibido un error fatal', ['error' => $usuario]);
            session(['error2' => '']);
        }

        //Hacemos un redirect hacia el controlador, a su metodo index
        return redirect()->action([UserController::class, "index"]);
    }

    /**
     * Elimina un usuario a partir del id, estableciendo un mensaje con el resultado
     *
     * @param  number  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Si se encuentra el id del usuario que queremos eliminar, mostramos un mensaje de exito
        try {
            $usuario = User::find($id);
            $usuario->borrado = 1;
            $usuario->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha borrado un usuario en la base de datos', ['usuario' => $usuario]);
            session(['succ3' => '']);

            // Por el contrario si no encontramos el id de este usuario, mostramos un mensaje de error
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado borrar un usuario en la base de datos y ha recibido un error fatal', ['error' => $usuario]);
            session(['error3' => '']);

        }
        return redirect()->route("usuarios");
    }
}
