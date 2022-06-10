<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formCliente extends Component
{
    
    public function __construct()
    {
        //
    }

    /**
     * Devuelve la vista que posee el componente
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-cliente');
    }
}
