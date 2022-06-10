<?php

namespace App\Auxiliar;

use App\Mail\SendInicioMail;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Datos;
use App\Models\Material;
use App\Models\Valla;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
use Dompdf\Options;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PdfClass
{
    protected $clienteModel;
    protected $contratoModel;
    protected $vallaModel;
    protected $datosModel;
    protected $materialModel;
    
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
     * Obtiene toda la informacion de los contratos 
     */
    public function build(Datos $datos ,Valla $vallas , Contrato $contratos , Cliente $clientes , Material $materiales, Request $request = null){
        $this->clienteModel = $clientes;
        $this->datosModel = $datos;
        $this->contratoModel = $contratos;
        $this->vallaModel = $vallas;
        $this->materialModel = $materiales;
        $dato = $this->datosModel->obtenerDatos();
        $contrato = $this->contratoModel->obtenerContrato($this->id);

        
        $vallasAsoc = $this->vallaModel->obtenerVallasDeContrato($this->id);
        $cliente = $this->clienteModel->obtenerCliente($contrato->id_cliente);

        // dd($contratoValla);
        $vallas2 = [];
        foreach($vallasAsoc as $vallaAsoc){
            array_push($vallas2 , [
                'vallas' => $this->vallaModel->obtenerValla($vallaAsoc->id_valla),
                'material' => $this->materialModel->obtenerMaterialPorId($vallaAsoc->id_material),
                'precio_produccion' => $vallaAsoc->precio_produccion,
            ]);
        }
        
        $nombreContrato = $cliente->nombre.'_'.$contrato->id.'.pdf' ;
        $nombreContrato = str_replace(' ' , '_' , $nombreContrato);
        $pdf = Pdf::loadview('pages.utilities.contrato' , [
            'datos' => $dato[0],
            'cliente' => $cliente ,
            'vallasAsoc' => $vallas2,
            'contrato'  => $contrato,
            'facturacion' => $request,
            
        ]);
            $options = new Options(); 
            $options->set('isPhpEnabled', 'true'); 
 
        
            if($contrato->baja == 1){        
                $canvas = $pdf->getDomPDF()->getCanvas();
        
            $fontMetrics = new FontMetrics($canvas, $options); 
        
            $w = $canvas->get_width(); 
            $h = $canvas->get_height(); 
            
            $font = $fontMetrics->getFont('times'); 
            
            $text = 'VENCIDO';

            $txtHeight = $fontMetrics->getFontHeight($font, 75); 
            $textWidth = $fontMetrics->getTextWidth($text, $font, 75); 

            $canvas->set_opacity(1); 
 
            $x = (($w-$textWidth)/2); 
            $y = (($h-$txtHeight)/3.5); 

            $canvas->page_text($x, $y, $text, $font, 100, [255,0,0] , 0.0 ,0.0 , 45 ); 
        }
        $pdf->render();
        file_put_contents('storage/pdfs/'.$nombreContrato , $pdf->output());
        $mensaje = [
            'cliente' => $cliente->nombre,
            'pdfNombre' => $nombreContrato,
        ];

        Mail::to($cliente->email)->send(new SendInicioMail($mensaje));
    }

    public function ViewPDF(Contrato $contratos , Cliente $clientes ){
        try{

            $this->contratoModel = $contratos;
            $this->clienteModel = $clientes;
            
            $contrato = $this->contratoModel->obtenerContrato($this->id);
            $cliente = $this->clienteModel->obtenerCliente($contrato->id_cliente);
        
            $pdf = new Dompdf();
            $nombreContrato =storage_path('pdfs\\'.$cliente->nombre.'_'.$contrato->id.'.pdf');
            $nombreContrato = str_replace(' ' , '_' , $nombreContrato);
            // dd($nombreContrato);
            header('Content-type: application/pdf');
  
            header('Content-Disposition: inline; filename="' .$nombreContrato. '"');
  
            header('Content-Transfer-Encoding: binary');
  
            header('Accept-Ranges: bytes');
  
            // Read the file
            readfile($nombreContrato);

            Log::info('Todo Correcto en la creacion del contrato');
        }catch(Exception $e){
            Log::error('El error es  : ' ,['error' => $e]);
        }
    }


}