<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MaterialController extends Controller
{

    protected $materialModel;

    public function __construct(Material $material)
    {
        $this->materialModel = $material;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiales = $this->materialModel->obtenerMateriales();

        return view('pages.admin.materiales', ["materiales" => $materiales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiales = $this->materialModel->obtenerMateriales();
        return view("pages.admin.materialform", ["mode" => "create", "materiales" => $materiales]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material = new Material($request->all());
        try {
            $material->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha guardado un material en la base de datos', ['material' => $material]);
            session(['succ1' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado guardar un material en la base de datos y hubo un error fatal', ['material' => $material]);
            session(['error1' => '']);
        }
        return redirect()->route("materiales");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = $this->materialModel->obtenerMaterial($id);

        return view('pages.admin.materialform', ["material" => $material, "id" => $material->id, "mode" => "show"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = $this->materialModel->obtenerMaterial($id);
        return view("pages.admin.materialform", ["material" => $material, "id" => $id, "mode" => "update"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $material = Material::find($id);
        $material->fill($request->all());
        try {
            $material->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado un material en la base de datos', ['material' => $material]);
            session(['succ2' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar un material en la base de datos y hubo un error fatal', ['material' => $material]);

            session(['error2' => '']);
        }
        return redirect()->action([MaterialController::class, "index"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::find($id);
        try {
            $material->borrado = 1;
            $material->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha borrado un cliente en la base de datos', ['material' => $material]);
            session(['succ3' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado borrar un cliente en la base de datos y ha recibido un error fatal', ['error' => $material]);
            session(['error3' => '']);
        }
        return redirect()->action([MaterialController::class, "index"]);
    }


    //Función que devuelve un json con los materiales de la base de datos. Pensado para recibir peticiones AJAX
    public function ajaxMateriales()
    {
        $select = $this->materialModel->obtenerMateriales();
        return json_encode($select);
    }
}
