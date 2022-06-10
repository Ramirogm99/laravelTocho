<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMaterialMail extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this
            ->subject('cambio de material')
            
            ->view('pages.utilities.emailMaterial')

            ->from(env('MAIL_FROM_ADDRESS'))

            ->with([
                'mensaje' => $this->mensaje->mensaje,

                'valla' => $this->mensaje->valla,

                'material' => $this->mensaje->material,
            ]);
    }
}
