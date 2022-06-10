<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Promocion;
use App\Models\Valla;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EstadoController extends Controller
{

    protected $estadoModel;
    protected $promocionModel;
    protected $vallaModel;
    

    public function __construct(Estado $estado, Promocion $promocion, Valla $valla)
    {
        $this->estadoModel = $estado;
        $this->promocionModel = $promocion;
        $this->vallaModel = $valla;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = $this->estadoModel->obtenerEstados();

        return view('pages.admin.estados', ["estados" => $estados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.admin.estadoform", ["mode" => "create"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estado = new Estado($request->all());
        try {
            $estado->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha guardado un estado en la base de datos', ['estado' => $estado]);
            session(['succ1' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado guardar un estado en la base de datos y hubo un error fatal', ['estado' => $estado]);
            session(['error1' => '']);
        }
        return redirect()->route("estados");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estado = $this->estadoModel->obtenerEstado($id);

        return view('pages.admin.estadoform', ["estado" => $estado, "id" => $estado->id, "mode" => "show"]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estado = $this->estadoModel->obtenerEstado($id);
        return view("pages.admin.estadoform", ["estado" => $estado, "id" => $id, "mode" => "update"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $estado = Estado::find($id);
        $estado->fill($request->all());
        try {
            $estado->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado un estado en la base de datos', ['estado' => $estado]);
            session(['succ2' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar un estado en la base de datos y hubo un error fatal', ['estado' => $estado]);

            session(['error2' => '']);
        }
        return redirect()->action([EstadoController::class, "index"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado = Estado::find($id);
        try {
            $estado->borrado = 1;
            $estado->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha borrado un estado en la base de datos', ['estado' => $estado]);
            session(['succ3' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado borrar un estado en la base de datos y ha recibido un error fatal', ['error' => $estado]);
            session(['error3' => '']);
        }
        return redirect()->action([EstadoController::class, "index"]);
    }





    


}
