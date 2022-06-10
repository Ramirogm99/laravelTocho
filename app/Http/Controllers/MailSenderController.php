<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionesEmail;
use App\Mail\SendMail;
use App\Mail\SendMaterialMail;
use App\Mail\SendReservaMail;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Material;
use App\Models\Notificaciones;
use App\Models\Valla;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailSenderController extends Controller
{
    //
    protected $vallaModel;
    protected $clienteModel;
    protected $notificacionesModel;
    protected $contratoModel;
    protected $materialModel;
    public function __construct(Cliente $clientes, Valla $vallas , Notificaciones $notificaciones , Contrato $contratos , Material $materiales)
    {
        $this->clienteModel = $clientes;
        $this->vallaModel = $vallas;
        $this->notificacionesModel = $notificaciones;
        $this->contratoModel = $contratos;
        $this->materialModel = $materiales;
    }
    /**
     * Crea el index para poder maquetar y seleccionar lo que se necesite de las vallas
     */
    public function index(Request $request)
    {
        $vallas = [];

        //carga todas las cosas necesarias para la elección del mail
        foreach ($request->checked as $valla) {
            array_push($vallas, $this->vallaModel->obtenerValla($valla));
        }
        $clientes = $this->clienteModel->obtenerClientesLite();
        
        return view('pages.utilities.mail', ['clientes' => $clientes, 'vallas' => $vallas]);
    }
    /**
     * Primero se pasa los datos por request y con estos maqueta hacia donde se mandan y que se hace con ellos
     * data un error si no se hace asi
     */
    public function send(Request $request)
    {
        $correo = $this->clienteModel->obtenerCliente($request->cliente);
        $request = $request->all();

        try {
            
            Mail::to($correo->email)->send(new SendMail($request));
            session(['succ' => '']);
            Log::info('Usuario: ' . Auth::user()->name . ' le ha enviado un correo a ' . $correo->email . '', ['Info' => $request]);
            return redirect()->to('contratos/vallasDisponibles');
        } catch (Exception $e) {
            session(['error' => '']);
            Log::error('Usuario: ' . Auth::user()->name . ' le ha enviado un correo a ' . $correo->email . ' y ha fallado ', ['Info' => $request , 'error' => $e]);
            return redirect()->to('contratos/vallasDisponibles');
        }
    }
    // public function sendMaterial($id){
    //     $contrato = $this->contratoModel->obtenerContrato($id);
    //     $cliente = $this->clienteModel->obtenerCliente($contrato->id_cliente);
    //     $vallas = $this->contratoModel->obtenerVallasContrato($id);
    //     $material = [] ;
    //     foreach($vallas as $valla){
    //         array_push($material , $this->materialModel->obtenerMaterial($valla->id_material));
    //     }
    //     $mensaje = [
    //         'material' =>  $material, 
    //         'cliente' => $cliente->nombre,

    //     ]; 
    //     try{
    //         Mail::to($cliente->email)->send(new SendMaterialMail($mensaje));
    //     }catch(Exception $e){
    //         session(['error'=> '']);
    //         Log::error('Usuario: '.Auth::user()->name. ' le ha enviado un correo a '.$cliente->email . ' sobre el cambio de materiales en sus vallas y ha fallado ' , ['Info'=> $cliente , 'error' => $e]);
    //     }
    // }

    public function sendReserva(Request $request)
    {
        $mensaje = $request->all();
        
        try{
            //aqui deberia ir el correo de paco // placeholder
            Mail::to('ramirogm99@gmail.com')->send(new SendReservaMail($mensaje));
            Log::info('El usuario ' .Auth::user()->name . ' le ha enviado un correo al admin sobre su reserva ' , ['Reserva' => $mensaje]);
            session(['succ' => '']);
            return redirect()->to('contratos/vallasDisponibles');
        }catch(Exception $e){
            session(['error'=> '']);
            Log::error('Usuario: ' . Auth::user()->name. ' le ha intentado enviar un correo al admin sobre su reserva pero ha tenido un error fatal' , ['Error' => $e]);
            return redirect()->to('contratos/vallasDisponibles');
        }
    }
}
