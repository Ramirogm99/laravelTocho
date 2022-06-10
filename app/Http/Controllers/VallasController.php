<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Estado;
use App\Models\Material;
use App\Models\Promocion;
use App\Models\Valla;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VallasController extends Controller
{

    protected $vallasModel;
    protected $estadoModel;
    protected $contratoModel;

    protected $materialModel;

    protected $promocionModel;

    public function __construct(Valla $vallas, Contrato $contrato, Estado $estado, Material $material, Promocion $promocion)
    {
        $this->vallasModel = $vallas;
        $this->contratoModel = $contrato;

        $this->estadoModel = $estado;
        $this->materialModel = $material;
        $this->promocionModel = $promocion;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vallas = $this->vallasModel->obtenerVallas();

        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            // session isn't started
            session_start();
        }
        if (isset($_SESSION["filtros"])) {

            $vallas = $_SESSION["filtros"];
            session_unset();

        }
        return view('pages.empresa.vallas', ["vallas" => $vallas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.empresa.vallaform", ["mode" => "create"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        

        try {
            $valla = new Valla($request->all());

            
            Storage::makeDirectory($valla->alias);

            if ($request->hasFile('norte')) {
                $valla->norte = $request->file('norte')->getClientOriginalName();
                Storage::put($valla->alias . "/" . $valla->norte, file_get_contents($request->file('norte')->getRealPath()));
                
            }

            if ($request->hasFile('sur')) {
                $valla->sur = $request->file('sur')->getClientOriginalName();
                Storage::put($valla->alias . "/" . $valla->sur, file_get_contents($request->file('sur')->getRealPath()));
                
            }

            if ($request->hasFile('este')) {
                $valla->este = $request->file('este')->getClientOriginalName();
                Storage::put($valla->alias . "/" . $valla->este, file_get_contents($request->file('este')->getRealPath()));
               
            }

            if ($request->hasFile('oeste')) {
                $valla->oeste = $request->file('oeste')->getClientOriginalName();
                Storage::put($valla->alias . "/" . $valla->oeste, file_get_contents($request->file('oeste')->getRealPath()));
                
            }

            $valla->save();

            Log::info('Usuario:' . Auth::user()->name . ' ha creado la valla en la base de datos', ['datos' => $valla]);

            session(['succ1' => '']);

        } catch (Exception $e) {

            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado crear la valla en la base de datos y ha recibido un error fatal', ['error' => $valla]);

            session(['error1' => '']);

        }

        return redirect()->route("vallas");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Valla  $vallas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $valla = $this->vallasModel->obtenerValla($id);

        return view('pages.empresa.vallaForm', ["valla" => $valla, "mode" => "showonly"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Valla  $vallas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $valla = $this->vallasModel->obtenerValla($id);

        return view('pages.empresa.vallaForm', ["valla" => $valla, "mode" => "update"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Valla  $vallas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $valla = Valla::find($id);

            $old_name = $valla->alias;

            $valla->fill($request->all());

            if ($request->hasFile('norte')) {
                $valla->norte = $request->file('norte')->getClientOriginalName();
                Storage::put($valla->alias . "/" . $valla->norte, file_get_contents($request->file('norte')->getRealPath()));
                
            }

            if ($request->hasFile('sur')) {
                $valla->sur = $request->file('sur')->getClientOriginalName();
                Storage::put($valla->alias . "/" . $valla->sur, file_get_contents($request->file('sur')->getRealPath()));
                
            }

            if ($request->hasFile('este')) {
                $valla->este = $request->file('este')->getClientOriginalName();
                Storage::put($valla->alias . "/" . $valla->este, file_get_contents($request->file('este')->getRealPath()));
               
            }

            if ($request->hasFile('oeste')) {
                $valla->oeste = $request->file('oeste')->getClientOriginalName();
                Storage::put($valla->alias . "/" . $valla->oeste, file_get_contents($request->file('oeste')->getRealPath()));
                
            }

            // rename folder if alias is changed

            if ($old_name != $valla->alias) {
                try {
                    Storage::disk('public')->move("{$old_name}", "{$valla->alias}");
                } catch (Exception $e) {
                   
                }
            }

            $valla->save();

            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado la valla en la base de datos', ['datos' => $valla]);

            session(['succ2' => '']);
        } catch (Exception $e) {

            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar la valla en la base de datos y ha recibido un error fatal', ['error' => $valla]);

            session(['error2' => '']);

        }
        return redirect()->action([VallasController::class, "index"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  number  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $valla = Valla::find($id);
            $valla->borrado = 1;
            $valla->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha borrado la valla en la base de datos', ['datos' => $valla]);

            session(['succ3' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado borrar la valla en la base de datos y ha recibido un error fatal', ['error' => $valla]);

            session(['error3' => '']);
        }
        return redirect()->action([VallasController::class, "index"]);
    }

    /**
     * Borra una imagen por su id
     */
    // public function deleteImage($id)
    // {

    //     try {
    //         $imagenesValla = Imgvallas::where('valla_id', $id)->get();

    //         foreach ($imagenesValla as $imagen) {
    //             $id_foto[] = $imagen->id;
    //         }

    //         $it = 0;
    //         foreach ($id_foto as $foto) {
    //             $vallaimg = Imgvallas::find($foto);
    //             $vallaimg->delete();
    //             $it++;
    //         }
    //         Log::info('Usuario:' . Auth::user()->name . ' ha borrado la imagen de la valla en la base de datos', ['datos' => $vallaimg]);

    //         session(['succ4' => '']);
    //     } catch (Exception $e) {
    //         Log::alert('Usuario:' . Auth::user()->name . ' ha intentado borrar la imagen de la valla en la base de datos y ha recibido un error fatal', ['error' => $imagenesValla]);

    //         session(['error4' => '']);
    //     }

    //     return redirect()->action([VallasController::class, "edit"], ["id" => $id]);

    // }

    /**
     * Request Ajax para el filtrado de vallas
     */
    public function ajaxVallas(Request $request)
    {
        //Selector de la request ajax

        switch ($request->tipo) {

            //  Devuelve las vallas sin contrato y con contratos que terminan
            //  antes del contrato que se pretende crear
            case "nuevo_contrato":
                $request->f_inicio = str_replace('T', ' ', date('Y-m-d H:i:s', strtotime($request->f_inicio)));
                $request->f_fin = str_replace('T', ' ', date('Y-m-d H:i:s', strtotime($request->f_fin)));

                $newObject = $this->vallasModel->obtenerVallasLibres();
                $select = $this->vallasModel->obtenerVallasLiberadas($request->f_inicio, $request->f_fin);

                return json_encode($select);
                break;
            case "ocupacion":
                break;

            case "maps":
                $maps = $this->vallasModel->obtenerMapa();
                foreach ($maps as $map) {

                    $estado = $this->estadoModel->obtenerEstado($map->id_estado);
                    $map->estado = $estado ? $estado->nombre : 'libre';
                    $map->color_estado = $estado ? $estado->color : '#00FF87';
                }

                return json_encode($maps);
                break;

            case "mapasContrato":
                $maps = $this->vallasModel->obtenerMapaContratadas();

                return json_encode($maps);
                break;

            case "mapasContratoId":
                $maps = $this->vallasModel->obtenerMapaContratoPorId($request->contrato);

                return json_encode($maps);
                break;

            case "mapasPromocion":
                $maps = $this->vallasModel->obtenerMapaPromociones();

                return json_encode($maps);
                break;

            case "mapasPromocionId":
                $maps = $this->vallasModel->obtenerMapaPromocionPorId($request->promocion);

                return json_encode($maps);
                break;

            case "vallas_disponibles":
                $request->f_inicio = str_replace('T', ' ', date('Y-m-d H:i:s', strtotime($request->f_inicio)));
                $request->f_fin = str_replace('T', ' ', date('Y-m-d H:i:s', strtotime($request->f_fin)));

                $newObject = $this->vallasModel->obtenerVallasLibres();

                $select = $this->vallasModel->obtenerVallasLiberadas($request->f_inicio, $request->f_fin);

                return json_encode($select);
                break;
            case "vallas_no_disponibles":
                $request->f_inicio = str_replace('T', ' ', date('Y-m-d H:i:s', strtotime($request->f_inicio)));
                $request->f_fin = str_replace('T', ' ', date('Y-m-d H:i:s', strtotime($request->f_fin)));
                if ($request == 'todos') {
                    return json_encode("error");
                }
                if ($request->id_valla == "todos") {
                    $newObject = $this->contratoModel->obtenerContratosVallas($request->f_inicio, $request->f_fin);
                } else {
                    $newObject = $this->contratoModel->obtenerContratosValla($request->id_valla, $request->f_inicio, $request->f_fin);
                }
                return json_encode($newObject);
                break;
            default:return "error";
                break;

        }

    }

    /**
     * Muestra un listado de las vallas contratadas
     */
    public function vallaOcupacion()
    {

        $vallas = $this->vallasModel->obtenerVallasContratadas();

        return view('pages.empresa.ocupaciones', ['vallas' => $vallas]);
    }

    /**
     * Muestra un formulario con datos para filtrar contratos
     */
    public function filtroFinalizando()
    {

        return view("pages.empresa.finalizandoform");

    }

    /**
     * Muestra un listado de las vallas próximas a finalizar
     */
    public function vallasPorFinalizar(Request $request)
    {
        $vallas = $this->vallasModel->obtenerVallasProxFinalización($request->f_fin, $request->plazo);

        return view("pages.empresa.finalizando", ['vallas' => $vallas, 'fecha' => str_replace('T', ' ', $request->f_fin)]);

    }

    /**
     * Muestra un listado con las vallas disponibles
     */
    public function filtroDisponibles(Request $request)
    {
        $request->f_inicio = str_replace('T', ' ', date('Y-m-d H:i:s', strtotime($request->f_inicio)));
        $request->f_fin = str_replace('T', ' ', date('Y-m-d H:i:s', strtotime($request->f_fin)));

        $newObject = $this->vallasModel->obtenerVallasLibres();

        $vallas = $this->vallasModel->obtenerVallasLiberadas($request->f_inicio, $request->f_fin);

        $it = 0;

        // foreach ($vallas as $valla) {

        //     $valla->fotos = [];

        //     foreach ($this->imgvallasModel->obtenerFotos($valla->id) as $fotosVallas) {

        //         array_push($valla->fotos, $fotosVallas->norte);
        //         array_push($valla->fotos, $fotosVallas->sur);
        //         array_push($valla->fotos, $fotosVallas->este);
        //         array_push($valla->fotos, $fotosVallas->oeste);

        //     }

        // }

        return view("pages.empresa.disponibles", ['vallas' => $vallas, 'f_inicio' => str_replace('T', ' ', $request->f_inicio), 'f_fin' => str_replace('T', ' ', $request->f_fin)]);
    }

    /**
     * Muestra un mapa con las vallas en su ubicacion coloreadas por estados
     */
    public function mapas()
    {
        $estados = $this->estadoModel->obtenerEstados();

        return view("pages.utilities.mapas", ['color' => '#ff0000', 'estados' => $estados]);
    }

    /**
     * Muestra un mapa con las vallas contratadas en su ubicación coloreadas por materiales
     */
    public function mapasContrato()
    {
        $contratos = $this->contratoModel->obtenerContratos();
        $materiales = $this->materialModel->obtenerMateriales();

        return view("pages.utilities.mapascontrato", ['color' => '#00FF87', 'contratos' => $contratos, 'materiales' => $materiales]);
    }

    public function mapasPromocion()
    {
        $promociones = $this->promocionModel->obtenerPromociones();
        $vallas = $this->vallasModel->obtenerVallasPromociones();

        return view("pages.utilities.mapaspromocion", ['vallas' => $vallas, 'promociones' => $promociones]);

    }

}
