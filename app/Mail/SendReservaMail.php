<?php

namespace App\Mail;

use App\Models\Valla;
use GuzzleHttp\Psr7\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendReservaMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $vallaModel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje)
    {
        //
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Valla $vallas)
    {
        $this->vallaModel = $vallas;
        $vallaArray = [];
        
        foreach($this->mensaje['checked'] as $message){
            array_push($vallaArray,$vallas->obtenerValla($message));

        }

            return $this->view('pages.utilities.emailReserva')
            ->subject('Reserva de vallas')
            ->from(Auth::user()->email)

            ->with([
                'fechas' => $this->mensaje,
                'vallas' => $vallaArray,
                'cliente' => Auth::user()->name
            ]);
    }
}
