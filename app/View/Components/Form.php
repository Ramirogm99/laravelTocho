<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Creamos el componente con el constructor
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Renderiza la vista a la que hace referencia el componente
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
