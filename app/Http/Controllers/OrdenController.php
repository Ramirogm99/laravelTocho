<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Valla;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
{

    protected $ordenModel;
    protected $vallaModel;

    public function __construct(Orden $orden, Valla $valla)
    {
        $this->ordenModel = $orden;
        $this->vallaModel = $valla;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = $this->ordenModel->obtenerOrdenes();

        return view('pages.admin.ordenes', ["ordenes" => $ordenes]);
    }

    public function completas()
    {
        $ordenes = $this->ordenModel->obtenerOrdenesCompletas();

        return view('pages.admin.ordenes', ["ordenes" => $ordenes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vallas = $this->vallaModel->obtenerVallas();
        return view("pages.admin.ordenform", ["mode" => "create", 'vallas' => $vallas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orden = new Orden($request->all());
        
        
       
        try {
            if ($request->hasFile('adj')) {
                
                $archivo = $request->file('adj')->store('ordenes');
                //se reemplazan las / por \ para que no haya error
                $archivo = str_replace('/', '\\', $archivo);
                $orden->adjunto = $archivo;
            }
            $orden->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha guardado una orden en la base de datos', ['orden' => $orden]);
            session(['succ1' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado guardar una orden en la base de datos y hubo un error fatal', ['orden' => $orden]);
            session(['error1' => '']);
        }
        foreach ($request->checked as $valla){
            DB::insert("insert into vallas_orden (id_valla, id_orden) values($valla, $orden->id)");
        }
        return redirect()->route("ordenes");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orden = $this->ordenModel->obtenerOrden($id);
        $vallas = $this->vallaModel->obtenerVallasOrden($orden->id);
        return view('pages.admin.ordenform', ["orden" => $orden, "id" => $orden->id, "mode" => "show", 'vallas' => $vallas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orden = $this->ordenModel->obtenerOrden($id);
        return view("pages.admin.ordenform", ["orden" => $orden, "id" => $id, "mode" => "update"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $orden = Orden::find($id);
        $orden->fill($request->all());
        try {
            $orden->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado una orden en la base de datos', ['orden' => $orden]);
            session(['succ2' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar una orden en la base de datos y hubo un error fatal', ['orden' => $orden]);

            session(['error2' => '']);
        }
        return redirect()->action([OrdenController::class, "index"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orden = Orden::find($id);
        try {
            $orden->borrado = 1;
            $orden->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha borrado un orden en la base de datos', ['orden' => $orden]);
            session(['succ3' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado borrar un orden en la base de datos y ha recibido un error fatal', ['error' => $orden]);
            session(['error3' => '']);
        }
        return redirect()->action([OrdenController::class, "index"]);
    }
}
