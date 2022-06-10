<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInicioMail extends Mailable
{
    use Queueable, SerializesModels;

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
    public function build()
    {
        return $this->view('pages.utilities.emailAlta')
        ->with([
            'cliente' => $this->mensaje['cliente'],
        ])
        ->subject('Alta de contrato')
        ->attach(storage_path('pdfs\\'.$this->mensaje['pdfNombre']));
    }
}
