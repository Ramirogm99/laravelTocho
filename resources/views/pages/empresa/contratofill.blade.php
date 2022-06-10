@php
date_default_timezone_set('Europe/Madrid');
$time = strtotime(now());
@endphp

{{-- Extiende de la plantilla --}}
@extends('adminlte::page')

{{-- Titulo de la ventana --}}
@section('title', 'Contratos')

{{-- Cabecera de la pagina --}}
@section('content_header')
    <h1>Datos Facturación Contrato</h1>
@stop



{{-- Contenido de la página --}}
@section('content')

<section class="content">
    <div class="box">
        <input type="hidden" id="urlapp" value="http://localhost/alquiler/">
        <div class="box-body">
            {{-- AL RELLENAR EL FORMULARIO SE ENVIARA LA INFORMACION A CREARUSUARIO EN LA RUTA --}}
            {{-- Dependiendo del modo que se le pase, accede a una ruta u otra --}}
            <form target="_blank" action="{{ url('') }}/contratos/newPdf/{{ $contrato->id }}" class="my_form row" enctype="multipart/form-data"
                method="post" accept-charset="utf-8" autocomplete="off" id="datos">
                @csrf
                <input type="hidden" id="csrfToken" value="{{ csrf_token() }}" name="csrfToken">
                <div class="col-12">
                    <div class="card card-primary card-outline">

                        {{-- CABECERA DEL FORMULARIO DE EDITAR --}}
                        <div class="card-header">
                            <h3 class="card-title">Formulario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>


                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="campana">Campaña*</label> <input type="text" name="campana" value=""
                                    id="campana" class="form-control input-lg" required>
                            </div>
                        </div>
                        {{-- CUERPO DEL FORMULARIO DE CREAR --}}
                        <div class="card-body row">
                            
                            


                            {{-- FORMA DE PAGO --}}
                        
                            

                            <div class="form-group col-md-6">
                                <label for="f_pago">Forma de Pago*</label> <input type="text" name="f_pago" value=""
                                    id="f_pago" class="form-control input-lg" required>
                            </div>

                            {{-- NUMERO DE CUENTA --}}
                            <div class="form-group col-md-6">
                                <label for="n_cuenta">Número de Cuenta*</label> <input type="text" name="n_cuenta"
                                    value="" class="form-control input-lg"  required
                                    id="n_cuenta">

                            </div>
                        
                            <div class="form-group col-md-6">
                                <label for="plazo_pag_i">Plazo inicial</label> <input type="date" name="plazo_pag_i" value="{{ date('Y-m-d', strtotime("$contrato->f_inicio")) }}"
                                    id="plazo_pag_i" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="plazo_pag_f">Plazo final</label> <input type="date" name="plazo_pag_f" value="{{ date('Y-m-d', strtotime("$contrato->f_fin")) }}"
                                    id="plazo_pag_f" class="form-control input-lg" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="f_pago">Observaciones</label> <input type="text" name="observaciones" value=""
                                    id="observaciones" class="form-control input-lg" required>
                            </div>


                        </div>

                        <div class="card-footer">
                            <a href="{{ url('/contratos') }}" class="btn btn-secondary float-left">Volver</a>
            
                            <button type="submit" id="generar_pdf" name="" 
                                class="btn btn-primary float-right">Generar PDF</button>
            
                        </div>

                    </div>
                    <div class="form-group col-md-4">
                    </div>
                </div>
        </div>
    </div>
    </div>

    {{-- 2 FORMULARIO --}}
   
    {{-- --------------------------------------------------------------------------------------------------------------------------- --}}
    {{-- --------------------------------------------------------------------------------------------------------------------------- --}}

    {{-- MODAL INSERCCION --}}

    
    </form>
    </div>
    </div>
</section>

@stop
