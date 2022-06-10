<?php

namespace App\Http\Controllers;

use App\Auxiliar\CommandClass;
use App\Models\Cliente;
use App\Models\Notificaciones;
use App\Models\Valla;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationsController extends Controller
{
    protected $vallaModel ;
    protected $clienteModel ; 
    protected $notificacionModel;
    //
    public function __construct(Notificaciones $notificaciones ,Valla $vallas , Cliente $clientes)
    {
        $this->vallaModel = $vallas;
        $this->clienteModel = $clientes;
        $this->notificacionModel = $notificaciones;
    }

    /**
     * Muestra un listado con las notificaciones pendientes
     */
    public function index()
    {   
        $vallasNotificaciones = $this->notificacionModel->obtenerNotificaciones();   
        $nombreCliente = array();
        
        foreach($vallasNotificaciones as $notifs){
            $nombreCli = $this->clienteModel->obtenerCliente($notifs->id_cliente);    
            array_push($nombreCliente ,[
                'name' => $nombreCli->nombre,
                'id_contrato' => $notifs->id_contrato,
                'id_cliente' => $nombreCli->id,
            ]); 
        }
        
        return view('pages.admin.notificaciones' , ['nombreCliente' => $nombreCliente]);
    }

    /**
     * Elimina las notificaciones pendiente
     */
    public function deleteNofiticaciones(){
        Notificaciones::where('borrado' ,0)->update(['borrado' => 1]);
        return  redirect()->to('/notificaciones');

    }

    
}
