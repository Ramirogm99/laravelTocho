<?php

namespace App\Http\Controllers;

use App\Auxiliar\PdfClass;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Datos;
use App\Models\Imgvallas;

use App\Models\Material;
use App\Models\Valla;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContratosController extends Controller
{

    protected $contratoModel;
    protected $clienteModel;
    protected $vallaModel;
    protected $materialModel;
  

    public function __construct(Contrato $contrato, Cliente $cliente, Valla $valla, Material $material)
    {
        $this->contratoModel = $contrato;
        $this->clienteModel = $cliente;
        $this->vallaModel = $valla;
        $this->materialModel = $material;

    }

    /**
     * Muestra un listado de los contratos activos
     * 
     */
    public function index()
    {
        $contratos = $this->contratoModel->obtenerContratos();

        
        $i = 0;
        foreach ($contratos as $contrato) {

            $contrato->precio = $this->contratoModel->obtenerPrecioContrato($contrato->id);

            $i++;
            $contrato->vallas = $this->contratoModel->obtenerVallasContrato($contrato->id);

            foreach ($contrato->vallas as $valla) {
                $id_material = $valla->id_material;

                $valla->material = $this->materialModel->obtenerMaterialPorId($id_material);

                $nombre_material = $valla->material->tipo;

            }

        }
        return view('pages.empresa.contratos', ["contratos" => $contratos]);
    }

    /**
     * Muestra un listado de los contratos en baja
     *
     * @return \Illuminate\Http\Response
     */
    public function bajas()
    {
        $contratos = $this->contratoModel->obtenerContratosBaja();
        foreach ($contratos as $contrato) {
            $contrato->precio = $this->contratoModel->obtenerPrecioContrato($contrato->id);
        }

        return view('pages.empresa.bajas', ["contratos" => $contratos]);
    }

    /**
     * Muestra un formulario avanzado para crear un nuevo contrato
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = $this->clienteModel->obtenerClientes();
        $materiales = $this->materialModel->obtenerMateriales();
        return view("pages.empresa.crearcontrato", ["clientes" => $clientes, 'materiales' => $materiales]);
    }

    /**
     * Guarda un nuevo contrato  y los datos de las vallas contratadas en la relación
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (is_null($request->AliasVallasContrato)) {
            return redirect()->back()->withErrors('El contrato debe contener al menos una valla');
        }

        date_default_timezone_set('Europe/Madrid');
        $request->f_inicio = str_replace('T', ' ', date('Y-m-d H:i', strtotime($request->f_inicio)));
        $request->f_fin = str_replace('T', ' ', date('Y-m-d H:i', strtotime($request->f_fin)));
        // Creamos el contrato
        $contrato = new Contrato(array(
            'f_inicio' => $request->f_inicio,
            'f_fin' => $request->f_fin,
            'id_cliente' => intval($request->id_cliente),
            'created_at' => date('Y-m-d H:i:s'),
        ));
        try {
            $contrato->save();
            
            Log::info('Usuario:' . Auth::user()->name . ' ha creado el contrato en la base de datos', ['contrato' => $contrato]);

            session(['contratosucc1' => '']);
        } catch (Exception $e) {
            Log::error('Usuario:' . Auth::user()->name . ' ha intentado crear el contrato en la base de datos y ha recibido un error fatal', ['error' => $contrato , 'CONTEXTO' => $e]);

            session(['contracterr1' => '']);
        }
        // Asignamos las vallas que van en ese contrato
        $it = 0;
        foreach ($request->AliasVallasContrato as $valla) {
            
            $this->vallaModel->insertarRelacionContratoVallas($contrato->id, $valla, $request->PrecioVallasContrato[$it], $request->PrecioMaterialVallasContrato[$it], $request->MaterialVallasContrato[$it]);
            
            $it++;
        }
        $this->vallaModel->checkEstados();
       
        return redirect()->route("contratos");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = $this->contratoModel->obtenerContrato($id);
        $clientes = $this->clienteModel->obtenerClientes();
        $materiales = $this->materialModel->obtenerMateriales();
        $cliente = $this->clienteModel->obtenerCliente($contrato->id_cliente);
        
        $vallasAlquiladas = $this->vallaModel->obtenerVallasDeContrato($id);

        $vallas = [];

        foreach ($vallasAlquiladas as $valla) {
            array_push($vallas, $this->vallaModel->obtenerValla($valla->id_valla));
        }

        foreach ($vallas as $valla) {
            $valla->precio = $this->vallaModel->obtenerPrecioValla($contrato->id, $valla->id);
            $valla->precio_material = $this->vallaModel->obtenerPrecioMaterialValla($contrato->id, $valla->id)==null?null:$this->vallaModel->obtenerPrecioMaterialValla($contrato->id, $valla->id);
            $valla->material = $this->vallaModel->obtenerMaterialValla($contrato->id, $valla->id);

           

        }
        return view("pages.empresa.contratoform", [
            "contrato" => $contrato,
            "clientes" => $clientes,
            "cliente" => $cliente,
            "vallas" => $vallas,
            'materiales' => $materiales,
            "mode" => "show",
        ]);
    }

    /**
     * Vista inicial para editar un contrato. En esta se puede modificar únicamente la fecha 
     * 
     */
    public function edit($id)
    {
        $contrato = $this->contratoModel->obtenerContrato($id);
        $clientes = $this->clienteModel->obtenerClientes();
        $cliente = $this->clienteModel->obtenerCliente($contrato->id_cliente);
        $vallasAlquiladas = $this->vallaModel->obtenerVallasDeContrato($id);
        $materiales = $this->materialModel->obtenerMateriales();

        $vallas = [];

        foreach ($vallasAlquiladas as $valla) {
            array_push($vallas, $this->vallaModel->obtenerValla($valla->id_valla));
        }

        foreach ($vallas as $valla) {
            $valla->precio = $this->vallaModel->obtenerPrecioValla($contrato->id, $valla->id);
            $valla->material = $this->vallaModel->obtenerMaterialValla($contrato->id, $valla->id);
            

        }


        return view("pages.empresa.editarcontrato", [
            "contrato" => $contrato,
            "clientes" => $clientes,
            "cliente" => $cliente,
            "vallas" => $vallas,
            "id" => $id,
            'materiales' => $materiales,
            "mode" => "update",

        ]);
    }

    /**
     * Formulario para editar un contrato. Aparecerá un listado de vallas pertenecientes al contrato, así como la opción de añadir y/o eliminar vallas del mismo
     * Este formulario no edita el contrato seleccionado, en su lugar genera un nuevo contrato a través de los datos rellenados en edit y en esta vista
     * y actualiza el anterior marcándolo como finalizado (en baja)
     */
    public function edit2(Request $request, $id)
    {
        $contrato = $this->contratoModel->obtenerContrato($id);
        $clientes = $this->clienteModel->obtenerClientes();
        $cliente = $this->clienteModel->obtenerCliente($contrato->id_cliente);
        $vallasAlquiladas = $this->vallaModel->obtenerVallasDeContrato($id);
        $materiales = $this->materialModel->obtenerMateriales();

        $vallas = [];

        foreach ($vallasAlquiladas as $valla) {
            array_push($vallas, $this->vallaModel->obtenerValla($valla->id_valla));
        }

        foreach ($vallas as $valla) {
            $valla->precio = $this->vallaModel->obtenerPrecioValla($contrato->id, $valla->id);
            $valla->precio_produccion = $this->vallaModel->obtenerPrecioMaterialValla($contrato->id, $valla->id);
            $valla->material = $this->vallaModel->obtenerMaterialValla($contrato->id, $valla->id);
            

        }

        
        return view("pages.empresa.editarvallascontrato", [
            "contrato" => $contrato,
            "clientes" => $clientes,
            "cliente" => $cliente,
            "vallas" => $vallas,
            "id" => $id,

            'materiales' => $materiales,
            "mode" => "update",


            'materiales'=> $materiales,
            'f_fin' =>  $request->f_fin = str_replace('T', ' ', date('Y-m-d H:i', strtotime($request->f_fin))),
            "mode" => "update"
            

        ]);
    }

    /**
     * Regenera el contrato, crea un registro del anterior contrato, asignándolo en baja en el momento en el que se efectúa
     * y genera un nuevo contrato con las vallas indicadas por request en la relación
     */
    public function update(Request $request, $id)
    {
     
        date_default_timezone_set('Europe/Madrid');
        $request->f_inicio = str_replace('T', ' ', date('Y-m-d H:i', strtotime($request->f_inicio)));
        $request->f_fin = str_replace('T', ' ', date('Y-m-d H:i', strtotime($request->f_fin)));
        $contrato = Contrato::find($id);
        $contrato->f_fin = str_replace('T', ' ', date('Y-m-d H:i'));
        $contrato->baja=true;
    

        try {
            //$precio = $request->precio;
            //$importe = $precio * 0,21; //el iva es el 21
            //$contrato->importe = $importe ; //es o esto o sacarlo con un calculo en js para quitarse de problemas
            //$contrato->save();
            
            $contrato->save();

            $newcontrato = new Contrato;
            $newcontrato->f_inicio= ($request->f_inicio > str_replace('T', ' ', date('Y-m-d H:i')))?$request->f_inicio:str_replace('T', ' ', date('Y-m-d H:i')) ;
            $newcontrato->f_fin= $request->f_fin;
            $newcontrato->id_cliente = $request->id_cliente;
            
            $newcontrato->save();

            $it = 0;
            foreach ($request->vallas as $valla) {
                if(isset($request->borrar)){
                    if(!in_array($valla, $request->borrar)){
                        $this->vallaModel->insertarRelacionContratoVallas($newcontrato->id, $valla, $request->precio[$it], $request->precio_produccion[$it], $request->material[$it]);
                    }
                }else{
                    $this->vallaModel->insertarRelacionContratoVallas($newcontrato->id, $valla, $request->precio[$it], $request->precio_produccion[$it], $request->material[$it]);
                }
                $it++;
            }
          
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado el contrato en la base de datos', ['contrato' => $contrato]);

            session(['contratosucc2' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar el contrato en la base de datos y ha recibido un error fatal', ['error' => $contrato]);

            session(['contracterr2' => '']);
        }

        $this->vallaModel->checkEstados();
        return redirect()->action([ContratosController::class, "index"]);
    }

    /**
     * Actualiza un contrato modificando la fecha 
     */
    public function update2(Request $request, $id)
    {
        
        date_default_timezone_set('Europe/Madrid');
        $request->f_inicio = str_replace('T', ' ', date('Y-m-d H:i', strtotime($request->f_inicio)));
        $request->f_fin = str_replace('T', ' ', date('Y-m-d H:i', strtotime($request->f_fin)));
        $contrato = Contrato::find($id);
        $contrato->fill($request->all());

        try {
            
            $contrato->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado el contrato en la base de datos', ['contrato' => $contrato]);
        
            session(['contratosucc2' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar el contrato en la base de datos y ha recibido un error fatal', ['error' => $contrato]);

            session(['contracterr2' => '']);
        }

        $this->vallaModel->checkEstados();
        return redirect()->action([ContratosController::class, "index"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrato = Contrato::find($id);
        try {
            //sale del modelo de contrato ya que no se puede borrar un contrato y para que quede un registro
            $contrato->baja = 1;
            $contrato->save();
           
            Log::info('Usuario:' . Auth::user()->name . ' ha dado de baja el contrato en la base de datos', ['contrato' => $contrato]);

            session(['contratosucc3' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado dar de baja el contrato en la base de datos y ha recibido un error fatal', ['error' => $contrato]);

            session(['contracterr3' => '']);
        }

        $this->vallaModel->checkEstados();
        return redirect()->action([ContratosController::class, "index"]);
    }


    /**
     * No hace nada y si lo hace te muestra algo a partir de la vista contratoform, con lo cual no hay nada en lo que la documentación pueda ayudar
     */
    public function filtro()
    {
        $contratos = $this->contratoModel->obtenerContratos();
        $clientes = $this->clienteModel->obtenerClientes();
        return view("pages.empresa.contratoform", ["mode" => "filtro", "clientes" => $clientes, "contratos" => $contratos]);

    }

    /**
     * Muestra un formulario para poder ver disponibilidad de las vallas
     */
    public function filtroValla()
    {
        return view("pages.empresa.disponibleform");

    }

    /**
     * Muestra un formulario para poder ver disponibilidad próxima de las vallas
     */
    public function filtroVallaNot()
    {
        $contratos = $this->contratoModel->obtenerContratos();
        $clientes = $this->clienteModel->obtenerClientes();
        $vallas = $this->vallaModel->obtenerVallas();
       
        return view("pages.empresa.contratoform", ["mode" => "filtro", 'filtro' => 'vallasNoDisponibles', "clientes" => $clientes, "vallas" => $vallas, "contratos" => $contratos]);

    }

    public function pdfView($id, Request $request){
        $pdf = new PdfClass($id);
        $pdf->ViewPDF( new Contrato() ,new Cliente() );
        

    }


    public function rellenarPdf($id){
        $contrato = $this->contratoModel->obtenerContrato($id);
        return view("pages.empresa.contratofill", ["contrato" => $contrato]);
    }


    public function newPdf($id, Request $request){

        $pdf = new PdfClass($id);
        $pdf->build(new Datos() , new Valla() , new Contrato() ,new Cliente() , new Material(), $request);
        $this->pdfView($id, $request);
        return redirect()->action([ContratosController::class, "index"]);
    }
    

}
