<?php

namespace App\Http\Controllers;


use App\Auxiliar\PdfClass;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Datos;
use App\Models\Imgvallas;
use App\Models\Material;
use App\Models\Valla;

use Exception;
use File;
use Ifsnop\Mysqldump as IMysqldump;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;


class ExportarController extends Controller
{
  

    public function __construct()
    {
   
    }

    /**
     * Muestra las opciones de exportar
     */
    public function index()
    {
       return view('pages.utilities.exportar');

    }

    /**
     * Exporta un fichero con los datos de la base de datos
     */
    public function export()
    {
        try {
            //nombro el archivo para su uso mas facil
            $filename = 'SaileSql.sql';
            //instancia del dump de la base de datos
            $dump = new IMysqldump\Mysqldump('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE') . '', env('DB_USERNAME'), env('DB_PASSWORD'));
            //se escribe sobre la base de datos dentro
            $dump->start($filename);

            //cabeceras necesarias para que se descargue el archivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/force-download');
            header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            ob_clean();
            flush();
            //lectura del archivo es decir descarga
            readfile($filename);
            Log::info('Usuario:' . Auth::user()->name . ' ha exportado la base de datos');
            //se cierra el stream
            exit();
            //se devuelve a la pagina anterior

        } catch (Exception $e) {
            Log::alert('Usuario:' . Auth::user()->name . ' ha intentado exportar la base de datos y ha recibido un error fatal');

            session(['error' => '']);
            //si hay error se devuelve a la pagina anterior y saltara un modal
            return redirect()->back();

        }
    }

    /**
     * Exporta un fichero comprimido con carpetas con el nombre de las vallas, dentro de las cuales se encuentran las imágenes asociadas. 
     * Además se exporta el fichero de la base de datos
     */
    public function exportimg()
    {
        try {

            // Get real path for our folder
            $rootPath = realpath(public_path('storage'));

// Initialize archive object
            $zip = new ZipArchive();
            $zip->open('queryImagenes.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
        /** 
         * @var SplFileInfo[]
         *  $files 
         * */
            $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY);

            foreach ($files as $name => $file)
            {
    // Skip directories (they would be added automatically)
                if (!$file->isDir())
                {
        // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
                    $zip->addFile($filePath, $relativePath);
                }
            }       

            $zip->close();
            header("Content-type: application/zip"); 
            header("Content-Disposition: attachment; filename=queryImagenes.zip");
            header("Content-length: " . filesize('queryImagenes.zip'));
            header("Pragma: no-cache"); 
            header("Expires: 0"); 

            readfile('queryImagenes.zip');
        // Zip archive will be created only after closing object

            exit();
        }catch (Exception $e) {
            Log::error('Usuario:' . Auth::user()->name . ' ha intentado exportar la base de datos y ha recibido un error fatal' , ['error' => $e]);

            session(['error' => '']);
            return redirect()->back();
        }
    }

}
