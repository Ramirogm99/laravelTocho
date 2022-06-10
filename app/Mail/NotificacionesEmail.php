<?php

namespace App\Mail;

use App\Models\Notificaciones;
use App\Models\Valla;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionesEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $vallaModel;
    protected $notificacionModel;
    protected $clienteModel;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
        
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Fin de contrato ')->view('pages.utilities.emailNotificacion')->from(env('MAIL_FROM_ADDRESS'))
        ->with(
            [
                'mensaje' => $this->mensaje['mensaje'],
                'vallas' => $this->mensaje['vallas'],
                'contratos' => $this->mensaje['contratos']
            ]
        );
    }
}
