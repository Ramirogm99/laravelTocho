<?php

namespace App\Auxiliar;

use App\Mail\NotificacionesEmail;
use App\Models\Notificaciones;
use Illuminate\Support\Facades\Mail;

Class EmailClass {

    protected $notificacionModel ;
    
    public function __construct(Notificaciones $notificaciones)
    {
        $this->notificacionModel = $notificaciones;
    }

    public function sendNotificacion(){
        $clientes = $this->notificacionModel->obtenerNotificaciones();
        //saco todas las vallas que tiene alquiladas el cliente y sus contratos asociados sin filtrar
        foreach($clientes as $clienteid){
            $clienteFin = $this->notificacionModel->obtenerNotificacionesPorCliente($clienteid->id_cliente);
            $ArrayVallas = array();
            $ArrayContrato = array();
            foreach($clienteFin as $cliente){
                array_push($ArrayVallas , [
                    'nombre_valla' => $cliente->nombre_valla,
                    'direccion' => $cliente->direccion,
                    'latitud' => $cliente->latitud,
                    'longitud' => $cliente->longitud,
                    
                ]);
                array_push($ArrayContrato ,[
                    'nombre_contrato' => $cliente->nombre_contrato,
                    'fecha_fin' => $cliente->fecha_fin,
                ]);
                $mensaje = [
                    'nombre' => $cliente->nombre,
                    'email' => $cliente->email,
                        
                ];
            }
            //Con esto se consigue que no se dupliquen los contratos asociados a dicho cliente
            $ArrayContrato = array_unique($ArrayContrato, SORT_REGULAR);
            $request = [
                'contratos' => $ArrayContrato,
                'mensaje' => $mensaje,
                'vallas' => $ArrayVallas
            ];
                Mail::to($mensaje['email'])->send(new NotificacionesEmail($request));
                // Mail::to('')->send(new NotificacionesEmail($request)); AQUI VA EL CORREO DEL ADMIN
                
        }
        Notificaciones::where('borrado' , '0')->update(['borrado' => 1]);
    }

}
