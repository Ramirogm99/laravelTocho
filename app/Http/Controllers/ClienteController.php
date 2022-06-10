<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{

    protected $clienteModel;
    protected $contratoModel;

    public function __construct(Cliente $cliente, Contrato $contrato)
    {
        $this->clienteModel = $cliente;
        $this->contratoModel= $contrato;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->clienteModel->obtenerClientes();
        return view('pages.admin.clientes', ["clientes" => $clientes]);
    }

    public function index2(){
        $clientes = $this->clienteModel->obtenerClientes();
        return view('pages.admin.usuarioclienteform', ['clientes' => $clientes]);
    }

    public function obtenerClienteAJAX(Request $request){
        $id_cliente = $request->id;
        $cliente = $this->clienteModel->obtenerCliente($id_cliente);
        return json_encode($cliente);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.admin.clienteform", ["mode" => "create"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cliente = new Cliente($request->all());
        try {
            $cliente->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha guardado un cliente en la base de datos', ['cliente' => $cliente]);
            session(['succ1' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado guardar un cliente en la base de datos y hubo un error fatal', ['cliente' => $cliente]);
            session(['error1' => '']);
        }
        return redirect()->route("clientes");
    }

    /**
     * Muestra los datos de un cliente a partir de su id
     *
     * @param  \App\Models\Request $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = $this->clienteModel->obtenerCliente($id);
        $contratos = $this->contratoModel->obtenerContratosCliente($id);

        return view('pages.admin.clienteform', ["cliente" => $usuario, "id" => $usuario->id, "mode" => "show", 'contratos'=>$contratos]);
    }



    /**
     * Muestra un formulario para la edicion de datos del cliente a partir del id de este
     *
     * @param  number  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = $this->clienteModel->obtenerCliente($id);
        $contratos = $this->contratoModel->obtenerContratosCliente($id);
        return view("pages.admin.clienteform", ["cliente" => $usuario, "id" => $id, "mode" => "update", 'contratos'=>$contratos]);
    }

    /**
     * Actualiza los datos de un cliente pasado por id y redirecciona al listado de clientes
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  number  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $usuario = Cliente::find($id);
        $usuario->fill($request->all());
        try {
            $usuario->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado un cliente en la base de datos', ['usuario' => $usuario]);
            session(['succ2' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar un cliente en la base de datos y hubo un error fatal', ['usuario' => $usuario]);

            session(['error2' => '']);
        }
        return redirect()->action([ClienteController::class, "index"]);
    }

    /**
     * Elimina un cliente a partir de su id y redirecciona al listado de clientes
     *
     * @param  number  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Cliente::find($id);
        try {
            $usuario->borrado = 1;
            $usuario->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha borrado un cliente en la base de datos', ['usuario' => $usuario]);
            session(['succ3' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado borrar un cliente en la base de datos y ha recibido un error fatal', ['error' => $usuario]);
            session(['error3' => '']);
        }
        return redirect()->action([ClienteController::class, "index"]);
    }
}
