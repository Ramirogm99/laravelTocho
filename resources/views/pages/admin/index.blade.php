{{-- ESTRUCTURA PAGINA DE PERFIL --}}

@extends('adminlte::page')

@section('title', 'Mis datos')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content_header')
    <h1>Mis datos</h1>
@stop

@section('content')

    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">General</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title=""
                        data-original-title="Abrir/Cerrar">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <form action="{{ url('misdatos/update') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body row">

                    {{-- NOMBRE FISCAL --}}
                    <div class="form-group col-md-6">
                        <label for="nombre_fiscal">Nombre fiscal</label> <input type="text" name="nombre_fiscal"
                            value="{{ $datos->nombre_fiscal }}" id="nombre_fiscal" class="form-control input-lg" required>
                    </div>

                    {{-- NOMBRE COMERCIAL --}}
                    <div class="form-group col-md-6">
                        <label for="nombre_comercial">Nombre comercial</label> <input type="text" name="nombre_comercial"
                            value="{{ $datos->d_social }}" id="nombre_comercial" class="form-control input-lg"
                            required>
                    </div>

                    {{-- CIF --}}

                    <div class="form-group col-md-3">
                        <label for="cif">CIF</label> <input type="text" name="cif" value="{{ $datos->CIF }}" id="cif"
                            class="form-control input-lg" required>
                    </div>

                    {{-- REPRESENTANTE --}}

                    <div class="form-group col-md-3">
                        <label for="representante">Representante</label> <input type="text" name="representante"
                            value="{{ $datos->representante }}" id="representante" class="form-control input-lg"
                            required>
                    
                    </div>
                    {{-- DIRECCION --}}
                    <div class="form-group col-md-3">
                        <label for="direccion">Dirección</label> <input type="text" name="direccion"
                            value="{{ $datos->direccion }}" id="direccion" class="form-control input-lg" required>
                    </div>

                    {{-- POBLACIÓN --}}
                    <div class="form-group col-md-3">
                        <label for="poblacion">Población</label> <input type="text" name="poblacion"
                            value="{{ $datos->localidad }}" id="poblacion" class="form-control input-lg" required>
                    </div>

                    {{-- PROVINCIA --}}
                    <div class="form-group col-md-3">
                        <label for="provincia">Provincia</label> <input type="text" name="provincia"
                            value="{{ $datos->provincia }}" id="provincia" class="form-control input-lg" required>
                    </div>

                    {{-- CODIGO POSTAL --}}
                    <div class="form-group col-md-3">
                        <label for="cod_postal">Código postal</label> <input type="text" name="cod_postal"
                            value="{{ $datos->codpost }}" id="cod_postal" class="form-control input-lg" maxlength="5"
                            required>
                    </div>

                    {{-- TELEFONO --}}
                    <div class="form-group col-md-2">
                        <label for="telefono">Teléfono</label> <input type="text" name="telefono"
                            value="{{ $datos->telefono }}" id="telefono" class="form-control input-lg" maxlength="9"
                            required pattern="^[67]{1}[0-9]{8}$">
                    </div>

                    {{-- FAX --}}
                    <div class="form-group col-md-2">
                        <label for="fax">Fax</label> <input type="text" name="fax" value="{{ $datos->fax }}" id="fax"
                            class="form-control input-lg">
                    </div>

                    {{-- MOVIL --}}
                    <div class="form-group col-md-2">
                        <label for="movil">Móvil</label> <input type="text" name="movil" value="{{ $datos->movil }}"
                            id="movil" class="form-control input-lg" maxlength="9" required pattern="^[67]{1}[0-9]{8}$">
                    </div>

                    {{-- EMAIL --}}
                    <div class="form-group col-md-3">
                        <label for="email1">Email 1</label> <input type="email" name="email1"
                            value="{{ $datos->email1 }}" id="email1" class="form-control input-lg" required
                            pattern='^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}$'>
                    </div>

                    {{-- EMAIL 2 --}}
                    <div class="form-group col-md-3">
                        <label for="email2">Email 2</label> <input type="email" name="email2"
                            value="{{ $datos->email2 }}" id="email2" class="form-control input-lg"
                            pattern="^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}$">
                    </div>

                    {{-- LOGO --}}
                    <div class="form-group col-4">
                        <label for="logotipo">Logotipo</label> <input type="file" name="logotipo" value="" id="logotipo"
                            accept="image/*" class="form-control input-lg">
                    </div>
                    
                    
                    
                </div>
                {{-- Imagen del logotipo de la empresa --}}
                    <div class="row d-flex justify-content-center m-2">
                <div id="contenedor" class="col-4  overflow-hidden text-center p-3 border rounded shadow-lg"
                        style=" overflow:hidden; padding:0;">
                        {{-- Imagen de la valla --}}
                        <img id="logo"{{--Imagen de la valla en si, en caso de que no se haya seleccionado ninguna, se pondra por defecto --}}
                            src="{{ url('') }}\public\storage\{{ $datos->logo ? $datos->logo : 'saile1.jpg' }}"
                            class="shadow rounded"
                            style="object-fit: contain;  max-width:475px; max-height: 400px; margin: 0 auto; transform: translateX(-1%)">

                    </div>
                </div>
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ url('misdatos') }}" class="btn btn-secondary float-left">Cancelar</a>
        <input type="button" name="modal" value="Guardar" data-toggle="modal" data-target="#modalmessage"
            class="btn btn-primary float-right">
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Se han producido cambios en los datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estos datos pueden llegar a ser irreversibles</p>
                    <p>¿Está usted seguro de que quiere continuar?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    @if (session()->has('succ'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'Los datos de la empresa se han actualizado correctamente',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('succ');
        @endphp
    @endif
    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al actualizar los datos de la empresa',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('error');
        @endphp
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {


            // Funcion para hacer una preview de la imagen subida

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#logo').attr('src', e.target.result);
                        $('#logotipo').attr('value', e.target.result);
                        console.log(e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }

            }
            $("#logotipo").change(function() {
                readURL(this);

            });
        })
    </script>
@stop
