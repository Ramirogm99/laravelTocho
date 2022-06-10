<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Valla;
use App\Models\Orden;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Image;

class WorkerController extends Controller
{


    protected $usuarioModel;
    protected $vallaModel;
    protected $ordenModel;

    public function __construct(User $usuario, Valla $valla , Orden $orden)
    {
        $this->usuarioModel = $usuario;
        $this->vallaModel = $valla;
        $this->ordenModel = $orden;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /** ******************************************************************************************************** */
    public function login(Request $request){
   
        $usuario = User::where('email', $request->email)->first();
        if(isset($usuario)){
            if(auth()->attempt(['email' => $request->email, 'password' => $request->contraseña])){
                return response()->json([$usuario->id, $usuario->react_token], 200, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
            }else{
                return response()->json("Contraseña errónea", 203, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
            }
        }else{
            return response()->json('Usuario no encontrado', 203, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
        }
    }

    public function ordenes(Request $request){
        //Traer todas las órdenes de trabajo y enviarlas a la SPA
        $ordenes = $this->ordenModel->obtenerOrdenes();
        //Controlar que la petición la realice un trabajador
        
        return $this->loged($ordenes, $request->id, $request->react_token);
       

    }

    public function ordenesCompletas(Request $request){
        //Traer todas las órdenes de trabajo y enviarlas a la SPA
        $ordenes = $this->ordenModel->obtenerOrdenesCompletas();
        //Controlar que la petición la realice un trabajador
        
        return $this->loged($ordenes, $request->id, $request->react_token);
       

    }

    public function ordenTrabajo(Request $request){
        //encontrar la orden de trabajo
        //$orden = Orden::find($request->id_orden)->first();
        $orden = $this->ordenModel->obtenerOrden($request->id_orden);
        $orden->vallas = $this->vallaModel->obtenerVallasOrden($orden->id);
        return $this->loged($orden, $request->id, $request->react_token);
    }

    public function valla(Request $request){
        $valla = $this->vallaModel->obtenerValla($request->id_valla);
        return $this->loged($valla, $request->id, $request->react_token);
    }


    public function getImageValla(Request $request){
        $valla = $this->vallaModel->obtenerValla($request->id_valla);
        
        switch ($request->posicion){
            case "norte":
                $path = public_path("storage\\$valla->norte");
                break;
            case "sur":
                $path = public_path("storage\\$valla->sur");
                break;
            case "este":
                $path = public_path("storage\\$valla->este");
                break;
            case "oeste":
                $path = public_path("storage\\$valla->oeste");
                break;
            default:
                $path = public_path("storage\\saile1.jpg");
                break;
        }
        
        
        $valla->imagen= Image::make($path)->response();
        if ($this->isLoged($request->id, $request->react_token)){
            return $valla->imagen;
        }else{
            return "Usuario no permitido";
        }
    }

    

    public function updateOrden(Request $request){
  
        $orden =  Orden::find($request->id_orden)->first();
        $orden->fill($request->all());
        if ($this->isLoged($request->id, $request->react_token)){
            $orden->save();
            return response()->json('Actualizado', 203, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
        }else{
            return response()->json('Error', 203, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
        }
    }


    public function completarOrden(Request $request){
        DB::update("update ordenes set completado=1 where id = $request->id_orden"); 

    }


    public function completarVallaOrden(Request $request){
        
        $valla = Valla::find($request->id_valla);
     
        //descomentar de abajo
        
        $valla->latitud= $request->latitud;
        $valla->longitud= $request->longitud;
        $valla->save();
        
        if($request->norte != null){

            try{
            unlink(public_path("storage\\".$valla->alias.'\\'.$valla->norte));
            }
            catch(Exception $e){

            }
            $request->norte->store($valla->alias);
            $valla->norte = $request->norte;
            //DB::update("update vallas set norte=$request->norte");
        }
        if($request->sur != null){

            try{
                unlink(public_path("storage\\".$valla->alias.'\\'.$valla->sur));
                }
                catch(Exception $e){
    
                }

            $request->sur->store($valla->alias);
            $valla->sur = $request->sur;
            //DB::update("update vallas set sur=$request->sur");
        }
        if($request->este != null){

            try{
                unlink(public_path("storage\\".$valla->alias.'\\'.$valla->este));
                }
                catch(Exception $e){
    
                }

            $request->este->store($valla->alias);
            $valla->este = $request->este;
            //DB::update("update vallas set este=$request->este");
        }
        if($request->oeste != null){

            try{
                unlink(public_path("storage\\".$valla->alias.'\\'.$valla->oeste));
                }
                catch(Exception $e){
    
                }

            $request->oeste->store($valla->alias);
            $valla->oeste = $request->oeste;
           // DB::update("update vallas set oeste=$request->oeste");
        }

        
        $valla->save();


        DB::update("update vallas_orden set completado=1 where id_valla = $request->id_valla and id_orden = $request->id_orden");

    }

    public function updateValla(Request $request){
        $valla = Valla::find($request->id_valla)->first();
        $valla->fill($request->all());
        if ($this->isLoged($request->id, $request->react_token)){
            $valla->save();
            return response()->json('Actualizado', 203, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
        }else{
            return response()->json('Error', 203, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
        }
    }

    // public function testFotos(Request $request){
    //     $valla = Valla::find($request->id_valla)->first();
    //     $valla->norte = public_path('storage\\' . $valla->norte);
        

         

            
        

    //     return response()->json(base64_encode(File::get($valla->norte)), 200, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
    // }

    

    public function loged($send, $id, $token){
        if(User::find($id)->react_token == $token){
            return response()->json($send, 200, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
        }else{
            return response()->json('Sin permiso' . User::find($id)->react_token . " " . $token, 203, ['Access-Control-Allow-Origin'=>'*', 'Vary' => 'origin']);
        }
    }

    public function isLoged($id, $token){
        if(User::find($id)->react_token == $token){
            return true;
        }else{
            return false;
        }
    }


}
