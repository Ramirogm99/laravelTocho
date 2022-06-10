@extends('adminlte::page')

@section('title', 'Exportar')

@section('content_header')
    <h1>Exportar</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card card-primary card-outline">

            {{-- CABECERA DEL FORMULARIO DE EDITAR --}}
            <div class="card-header">
                <h3 class="card-title">Selecione cómo quiere exportar</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-around">
                    <a href="{{ url('exportar/exportwo') }}" class='btn btn-m btn-primary col-4 float-left'>Exportar sin
                        imagenes</a>

                    <a href="{{ url('exportar/exportwh') }}" class='btn btn-m btn-primary col-4 float-right'>Exportar con
                        imagenes</a>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al exportar',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('error');
        @endphp
    @endif

@stop
