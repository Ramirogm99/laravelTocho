<?php

namespace App\Console\Commands;

use App\Auxiliar\CommandClass;
use App\Models\Notificaciones;
use App\Models\Valla;
use Illuminate\Console\Command;

class NotificacionIntro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NotificacionIntro';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera las notificaciones cada minuto';

    protected $vallaModel ;
    protected $notificacionModel ;
    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct(Valla $vallas , Notificaciones $notificaciones)
    {
        parent::__construct();

        $this->vallaModel = $vallas;
        $this->notificacionModel = $notificaciones;

    }

    /**
     * Execute the console command.
    //  *
     * @return int
     */
    public function handle()
    {
        $datos = new CommandClass(new Valla() , new Notificaciones());
        $datos->addNotificaciones();
        $this->info('Esto ha funcionado');
    }
}
