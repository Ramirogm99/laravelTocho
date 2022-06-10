<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ExportarController;
use App\Http\Controllers\MailSenderController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VallasController;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/**
 * Ruta de login
 */
Route::get('/', function () {
    if (Auth::check()) {
        if(Auth::user()->auth_level == 1){
            
            return redirect('/contratos/vallasDisponibles');
        }
        return redirect('/vallas/mapas');
    }
    if (session_status() === PHP_SESSION_NONE) {return view('auth.login');} else {
        return redirect('/vallas/mapas');
    }

});

/**
 * Ruta a página inicial Datos de Empresa
 */
Route::get('/misdatos', function () {
    if (!Auth::check()) {
        return redirect("/");
    }
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        // session isn't started
        session_start();
    } else {
        return redirect('/');
    }
    return view('pages.admin.index');
});

/**
 * Rutas del crud de Usuario en formato middleware de laravel
 */
Route::middleware("auth")->controller(UserController::class)->prefix('usuarios')->group(function () {
    Route::get('usuarioform', "create");
    Route::get("/", "index")->name("usuarios");
    Route::post("insert", "store");
    Route::get("edit/{id}", "edit");
    Route::post("update/{id}", "update");
    Route::get("delete/{id}", "destroy");
    Route::get("show/{id}", "show");
});

/**
 * Rutas del crud de Cliente en formato middleware de laravel
 */
Route::middleware("auth")->controller(ClienteController::class)->prefix('clientes')->group(function () {

    Route::get('clienteform', "create");
    Route::get("/", "index")->name("clientes");
    Route::post("insert", "store");
    Route::get("edit/{id}", "edit");
    Route::post("update/{id}", "update");
    Route::get("delete/{id}", "destroy");
    Route::get("show/{id}", "show");
    Route::get('registercli' , 'index2');
    Route::post('show2' , 'show2');
    Route::post('clienteUser' , 'obtenerClienteAJAX');
    
});

/**
 * Rutas del crud de Estado en formato middleware de laravel
 */
Route::middleware("auth")->controller(EstadoController::class)->prefix('estados')->group(function () {
    Route::get('estadoform', "create");
    Route::get("/", "index")->name("estados");
    Route::post("insert", "store");
    Route::get("edit/{id}", "edit");
    Route::post("update/{id}", "update");
    Route::get("delete/{id}", "destroy");
    Route::get("show/{id}", "show");
});

/**
 * Rutas del crud de Ordenes en formato middleware de laravel
 */
Route::middleware("auth")->controller(OrdenController::class)->prefix('ordenes')->group(function () {
    Route::get('ordenform', "create");
    Route::get("/", "index")->name("ordenes");
    Route::post("insert", "store");
    Route::get("edit/{id}", "edit");
    Route::post("update/{id}", "update");
    Route::get("delete/{id}", "destroy");
    Route::get("show/{id}", "show");
    Route::get("completas", "completas");
});


/**
 * Rutas del crud de Promocion en formato middleware de laravel
 */
Route::middleware("auth")->controller(PromocionController::class)->prefix('promociones')->group(function () {
    Route::get('promocionform', "create");
    Route::get("/", "index")->name("promociones");
    Route::post("insert", "store");
    Route::get("edit/{id}", "edit");
    Route::post("update/{id}", "update");
    Route::get("delete/{id}", "destroy");
    Route::get("show/{id}", "show");
    Route::get("promociones", "promociones");
    Route::get("promocionform", "create");
    Route::get("asignarPromociones/{id}", "asignarPromociones");
    Route::post("updateVallasPromocion", "updateVallasPromocion");
});


/**
 * Rutas del crud de Material en formato middleware de laravel
 */
Route::middleware("auth")->controller(MaterialController::class)->prefix('materiales')->group(function () {
    Route::get('materialform', "create");
    Route::get("/", "index")->name("materiales");
    Route::post("insert", "store");
    Route::get("edit/{id}", "edit");
    Route::post("update/{id}", "update");
    Route::get("delete/{id}", "destroy");
    Route::get("show/{id}", "show");
    Route::post("ajaxRequest", 'ajaxMateriales');
});

/**
 * Rutas del crud de Vallas en formato middleware de laravel
 */
Route::middleware("auth")->controller(VallasController::class)->prefix('vallas')->group(function () {
    Route::get('vallaform', "create");
    Route::get("/", "index")->name("vallas");
    Route::post("insert", "store");
    Route::get("edit/{id}", "edit");
    Route::post("update/{id}", "update");
    Route::get("delete/{id}", "destroy");
    Route::get("show/{id}", "show");
    Route::get("filtro/{message}", "filter");
    Route::post("ajaxRequest", 'ajaxVallas');
    Route::post("filtroDisponibles", "filtroDisponibles");
    Route::get("ocupacion", "vallaOcupacion");
    Route::get("finalizando", "filtroFinalizando");
    Route::post("porFinalizar", "vallasPorFinalizar");
    Route::get("borrarImagen/{id}", "deleteImage");
    Route::get("mapas", "mapas");
    Route::get("mapasContrato", "mapasContrato");
    Route::get("mapasPromocion", "mapasPromocion");
});

/**
 * Rutas del crud de contratos en formato middleware de laravel
 */
Route::middleware("auth")->controller(ContratosController::class)->prefix('contratos')->group(function () {
    Route::get('crearContrato', "create");
    Route::get("/", "index")->name("contratos");
    Route::post("insert", "store");
    Route::get("edit/{id}", "edit");
    Route::post("edit2/{id}", "edit2");
    Route::post("update/{id}", "update");
    Route::post("update2/{id}", "update2");
    Route::get("delete/{id}", "destroy");
    Route::get("show/{id}", "show");
    Route::get("bajas", "bajas");
    Route::get("ocupacionPorVallas", "filtroVallaNot");
    Route::get("vallasDisponibles", "filtroValla");
    Route::post('pdf/{id}','pdfView');
    Route::post('newPdf/{id}','newPdf');
    Route::get("rellenarContrato/{id}", "rellenarPdf");

});

Route::middleware('auth')->controller(MailSenderController::class)->prefix('mail')->group(function () {
    Route::post('/', 'index')->name('email');
    Route::post('enviar', 'send');
    Route::post('reserva' , 'sendReserva');
});
//ruta al exportador
Route::middleware("auth")->controller(ExportarController::class)->prefix('exportar')->group(function () {
    Route::get("/", "index")->name("exportar");
    Route::get('exportwo', 'export');
    Route::get('exportwh', 'exportimg');
});

/**
 * Rutas del crud de datos de empresa en formato middleware de laravel
 */

Route::middleware("auth")->controller(DatosController::class)->prefix('misdatos')->group(function () {
    Route::get('/', 'index')->name("datos");
    Route::post('update', 'update');
});

/**
 * Ruta a plantilla del proyecto
 */
Route::get('/perfil', function () {
    if (!Auth::check()) {
        return redirect("/");
    }
    return view('pages.admin.index');
});

/**
 * Rutas por defecto de autenticación
 */
Route::group(['middleware' => 'prevent-back-history'], function () {
    Auth::routes();
    Route::get('/home', 'HomeController@index');
});

/**
 * 
 */
Route::middleware('auth')->controller(NotificationsController::class)->prefix('notificaciones')->group(function(){
    Route::get('/' , 'index')->name('notificaciones');
    Route::get('borrar' , 'deleteNofiticaciones');
    Route::get('notificacionSend' , function(){
        $enviar = Artisan::call('ContratoClientes');
        return redirect()->back();
    });
});

/**
 * NO SE USA EN EL PROYECTO
 * Ruta por defecto de Home Controller para el acceso a páginas
 */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Ruta para el cierre de sesion
 */
Route::get('logout', [LoginController::class, "logout"]);
