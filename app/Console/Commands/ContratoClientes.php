<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Auxiliar\EmailClass;
use App\Models\Notificaciones;

class ContratoClientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ContratoClientes';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo a todos los clientes y a Paco Elias Ordoñez';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $email = new EmailClass(new Notificaciones());
        $email->sendNotificacion();
        $this->info('Esto ha funcionado');

    }
}
