<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use Illuminate\Http\Request;
use App\Models\Valla;
use App\Models\Contrato;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class PromocionController extends Controller
{

    protected $vallaModel;
    protected $promocionModel;
    

    public function __construct(Promocion $promocion, Valla $valla)
    {
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
        $promociones = $this->promocionModel->obtenerPromociones();

        return view('pages.utilities.promociones', ['promociones' => $promociones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promociones = $this->promocionModel->obtenerPromociones();
        $vallas = $this->vallaModel->obtenerVallas();        

        return view('pages.utilities.promocionform', ['promociones'=>$promociones, 'vallas'=> $vallas, 'mode' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promocion = new Promocion($request->all());
        try {
            $promocion->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha guardado una Promocion en la base de datos', ['promocion' => $promocion]);
            session(['succ1' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado guardar una Promocion en la base de datos y hubo un error fatal', ['promocion' => $promocion]);
            session(['error1' => '']);
        }
        return redirect()->route("promociones");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promocion = $this->promocionModel->obtenerPromocion($id);
        $contratos = $this->promocionModel->obtenerContratosConPromocion($id);
    

        return view('pages.utilities.promocionform', ["promocion" => $promocion, "id" => $promocion->id, "contratos"=>$contratos, "mode" => "show"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promocion = $this->promocionModel->obtenerPromocion($id);

        return view('pages.utilities.promocionform', ["promocion" => $promocion, "id" => $promocion->id, "mode" => "update"]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promocion = Promocion::find($id);
        $promocion->fill($request->all());
        try {
            $promocion->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado una promocion en la base de datos', ['promocion' => $promocion]);
            session(['succ2' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar una promocion en la base de datos y hubo un error fatal', ['promocion' => $promocion]);

            session(['error2' => '']);
        }
        return redirect()->action([PromocionController::class, "index"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promocion = Promocion::find($id);
        try {
            $promocion->borrado = 1;
            $promocion->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha borrado un cliente en la base de datos', ['promocion' => $promocion]);
            session(['succ3' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado borrar un cliente en la base de datos y ha recibido un error fatal', ['error' => $promocion]);
            session(['error3' => '']);
        }
        return redirect()->action([PromocionController::class, "index"]);
    }

    public function asignarPromociones($id){
        $promocion = $this->promocionModel->obtenerPromocion($id);
        $vallas = $this->vallaModel->obtenerVallas();

        foreach($vallas as $valla){
            $valla->check = $this->promocionModel->checkPromocion($valla->id, $id);
        }

        return view('pages.utilities.asignaPromocion', ['vallas' => $vallas, 'promocion'=>$promocion]);
    }


    public function updateVallasPromocion(Request $request){
        DB::delete("delete from promocion_valla where id_promocion=$request->promocion");
        if(isset($request->checked)){
            foreach($request->checked as $valla){
                DB::insert("insert into promocion_valla (id_promocion, id_valla) values($request->promocion, $valla)");
            }
        }
        return redirect()->action([PromocionController::class, "index"]);
    }    

}
