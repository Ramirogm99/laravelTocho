<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Auxiliar\pdfClass;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Valla;

class DatosController extends Controller
{
    protected $datosModel;

    public function __construct(Datos $datos)
    {
        $this->datosModel = $datos;
    }

    /**
     * Función inicial para mostrar los datos empresariales
     */
    public function index()
    {
        //Si la persona no esta loggeada
        if (!Auth::check()) {
            return redirect("/");
        }

        //Si la persona esta logueada, devolvemos todos los datos que encontremos en la tabla de datos
        $datos = $this->datosModel->obtenerDatos();
        return view('pages.admin.index', ["datos" => $datos[0]]);

        //El $datos[0] es porque en esta tabla solamente va a haber una fila
    }

    /**
     * Función para actualizar los datos empresariales. Tras esto recarga la página de datos
     * @param  \App\Models\Request $request
     */

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect("/");
        }

        //Obtenemos los datos y lo asignamos a una variable datos
        $datos = $this->datosModel->obtenerDatos();

        //Rellenamos los datos con lo obtenido por la request (que viene del formulario) y guardamos
        $datos[0]->fill($request->all());

        if (isset($request->logotipo)) {

            $archivo = $request->file('logotipo')->store('');

            //se reemplazan las / por \ para que no haya error
            $archivo = str_replace('/', '\\', $archivo);
            $datos[0]->logo = $archivo;

        }

        try {
            $datos[0]->save();
            Log::info('Usuario:' . Auth::user()->name . ' ha actualizado los datos de la empresa en la base de datos', ['datos' => $datos]);
            session(['succ' => '']);
        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado actualizar los datos de la empresa en la base de datos y ha recibido un error fatal', ['error' => $datos]);
            session(['error' => '']);
            redirect()->back();
        }

        //Hacemos una llamada a la función index del controlador
        return redirect()->action([DatosController::class, "index"]);
    }
}
