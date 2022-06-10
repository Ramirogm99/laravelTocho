<?php

namespace App\Mail;

use App\Models\Cliente;
use App\Models\Valla;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje ;
    public $vallaModel;
    public $clienteModel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje)
    {
        $this->mensaje =$mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Cliente $clientes ,Valla $vallas )      
    {
        $this->clienteModel = $clientes;
        $this->vallaModel = $vallas;

        $texto = $this->mensaje['texto'];
        
        $cliente = $clientes->obtenerCliente($this->mensaje['cliente']) ;
        $cliente = $cliente->nombre;
        $vallaArray = [];
        
        for($i = 0 ; $i< count($this->mensaje['vallas']); $i++){
            array_push($vallaArray,$vallas->obtenerValla($this->mensaje['vallas'][$i]));
        }
        // dd($cliente , $texto ,$vallaArray);
        $this
            ->subject('Vallas disponibles')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->view('pages.utilities.email')
            ->with([
                'texto'=> $texto,
                'cliente' => $cliente,
                'vallas' => $vallaArray,
            ]);
    }
}
