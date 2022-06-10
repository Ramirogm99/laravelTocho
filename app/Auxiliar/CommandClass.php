<?php

namespace App\Auxiliar;

use App\Models\Notificaciones;
use App\Models\Valla;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

Class CommandClass {

    protected $vallaModel ;
    protected $notificacionModel ;

    public function __construct(Valla $vallas , Notificaciones $notificaciones)
    {
        
        $this->vallaModel = $vallas;
        $this->notificacionModel = $notificaciones;
    }

    public function addNotificaciones(){
        try{       
            
        DB::beginTransaction();
        $hoynoformat = getdate()[0];
    //Este es el dia de hoy
        $hoy = date('Y-m-d H:i:s' , $hoynoformat);
    //Se obtienen los contratos a punto de finalizar
        $ContratoProxFin = $this->vallaModel->obtenerVallasProxFinalización($hoy, 30);
    //Se obtienen las notificaciones para ver si 
        $notificaciones = $this->notificacionModel->obtenerTodasNotificaciones();
 
        
        foreach($ContratoProxFin as $ContratoFin){
            $isFound = false;
            if(isset($notificaciones)){
                
                foreach($notificaciones as $notifi){
                    if($ContratoFin->id_contrato ==  $notifi->id_contrato){
                        
                        $isFound = true; 
                    }
               
                
                  
                }
                if(!$isFound){

                 
                    $notificacionnew = new Notificaciones();
                    $notificacionnew->id_cliente = $ContratoFin->id_cliente;
                    $notificacionnew->id_contrato = $ContratoFin->id_contrato;
                    $notificacionnew->borrado= 0;
                    $notificacionnew->save();
                }
            }else{
                $notificacionnew = new Notificaciones();
                    $notificacionnew->id_cliente = $ContratoFin->id_cliente;
                    $notificacionnew->id_contrato = $ContratoFin->id_contrato;
                    $notificacionnew->borrado= 0;
                    $notificacionnew->save();
            }

        }
    DB::commit();
}catch(Exception $e){
   DB::rollBack();
   Log::error('Ha habido un error al crear las notificaciones' , ['error' => $e]);
}
    }
}
