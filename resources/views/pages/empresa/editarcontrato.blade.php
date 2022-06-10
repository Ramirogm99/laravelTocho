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
    <h1>Editar Contrato</h1>
@stop



{{-- Contenido de la página --}}
@section('content')

{{-- FORMULARIO CONTRATO --}}
<p class="d-none">{{ date_default_timezone_set('Europe/Madrid') }}</p>

<section class="content">
    <div class="box">
        <input type="hidden" id="urlapp" value="http://localhost/alquiler/">
        <div class="box-body">
            <form method="post" action='{{ url("contratos/update/$contrato->id") }}' class="my_form row" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8" autocomplete="off">
                        <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="b2697287">
                        
                        <div class="col-12">
                            <div class="card card-primary card-outline">
            
                                {{-- CABECERA DEL FORMULARIO DE EDITAR --}}
                                <div class="card-header">
                                    <h3 class="card-title">General</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
            
                                {{-- CUERPO DEL FORMULARIO --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">

                                            <label for="f_inicio">Fecha de inicio*</label> <input type="date"
                                                name="f_inicio" id="f_inicio"
                                                
                                                value="{{ $contrato ? str_replace(' ', 'T', date('Y-m-d', strtotime("$contrato->f_inicio"))) : '' }}"
                                                id="f_inicio" class="form-control input-lg"
                                            required readonly>
                                        </div>
            
                                        {{-- FECHA FIN --}}
                                        <div class="form-group col-md-6">
                                            <label for="f_fin">Fecha de vencimiento*</label> <input type="date"
                                                name="f_fin" id="f_fin"
                                                value="{{ $contrato ? str_replace(' ', 'T', date('Y-m-d', strtotime("$contrato->f_fin"))) : '' }}"
                                                min="{{ str_replace(' ', 'T', date("$contrato->f_inicio")) }}"
                                                class="form-control input-lg" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="id_cliente">Cliente</label>
                                            <select name="id_cliente" id="id_cliente"
                                                class="form-control "
                                                data-select2-id="auth_level_user"
                                                tabindex="-1"
                                                aria-hidden="true" >
                                                <option selected value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                                
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 
                                                    <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Foto</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img id="fotoModal" src=""
                                                                        style="object-fit: contain;  max-width:470px; max-height: 440px; margin: 0 auto;" />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary "
                                                                        data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                        {{-- FOOTER DEL FORMULARIO --}}
                                        <div class="col-12">
                                            <div class="card-footer">
                                                <a href="{{ url('contratos') }}"
                                                    class="btn btn-secondary float-left">Volver</a>
                                                    
                                                    
                                                    <button id='submit' type="button" name="mysubmit" 
                                                     value="Guardar"
                                                    data-toggle="modal" data-target="#modalmessage" class="btn btn-warning float-right">
                                                    Guardar Cambios
                                                    </button>

                                                    <button id='submit1' type="button" name="mysubmit" 
                                                    value="Guardar"
                                                data-toggle="modal" data-target="#modalmessage1" class="btn btn-warning float-right mr-2">
                                                    Editar Vallas
                                                    </button>
                                            </div>
                                        </div>
                                    
                                </div>
                           
                        
                            <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de
                                            inserción/actualización</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Desea guardar los cambios? </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button id='submit'  type="submit" name="mysubmit"
                                            value="Guardar"
                                            formMethod="post" formaction='{{ url("contratos/update2/$contrato->id") }}'
                                          class="btn btn-primary ml-2 ">
                                           Guardar Cambios
                                           </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalmessage1" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de
                                        inserción/actualización</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Desea editar las vallas del contrato? </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  
                                    <button type="submit" formMethod="post" formaction='{{ url("contratos/edit2/$contrato->id") }}' class="btn btn-warning">EditarVallas</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                   
                
            </div>
        </div>
        </form>
</section>

<script>

    function changeUrl(){
        
    }

</script>

@stop                

