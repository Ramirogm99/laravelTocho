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
    <h1>Vallas Próximas a Finalizar en {{ $fecha }}</h1>
@stop



{{-- Contenido de la página --}}
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="tablacontratos" style="width:100%; border: 0;"
                                class="table table-hover table-striped table-bordered table-sm display">
                                <thead class="thead-tabla">
                                    <tr>

                                        <th style="text-align: center; vertical-align: middle;" data-field="Cliente">Cliente</th>
                                        <th style="text-align: center; vertical-align: middle;" data-field="Inicio">Valla</th>
                                        <th style="text-align: center; vertical-align: middle;" data-field="id">Contrato</th>
                                        <th style="text-align: center; vertical-align: middle;" data-field="Fin">Finaliza en:</th>
                                        {{-- <th data-field="Estado">Restante</th> --}}
                                        <th style="text-align: center; vertical-align: middle;" data-field="Acciones" id="acciones" class="max-width:100px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($vallas as $valla)
                                        {{-- Calculo del numero de dias restantes --}}


                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;" >{{ $valla->cliente }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $valla->alias }} </td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $valla->id_contrato }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $valla->dias }} días</td>
                                            {{-- Estado con colores --}}
                                            {{-- <td id="restante"
                                                style="display: flex; flex-direction:row; justify-content: space-between">
                                                <p>{{ $dias }}</p>
                                                <p style="background-color:blue;
                                                    display:inline-block;
                                                    height:20px;
                                                    width:20px;
                                                    border-radius:50%;
                                                    "
                                                    @if ($dias < 5) class="bg-danger" @elseif ($dias < 15) class="bg-warning" @elseif ($dias == 'En reserva') class="bg-info" @else class="bg-success" @endif>
                                                    ㅤ </p>
                                            </td> --}}



                                            <td style="text-align: center; vertical-align: middle;">
                                                {{-- BOTONES DE ACCION --}}
                                                <a href='{{ url('') }}/contratos/show/{{ $valla->id_contrato }}'
                                                    class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>

                                                <a href="{{ url('') }}/contratos/edit/{{ $valla->id_contrato }}"
                                                    class='btn btn-sm btn-info'><i class="fas fa-pencil-alt"></i></a>

                                                {{-- Boton borrar que envia a un modal --}}

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#tablacontratos').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },


            });
        });
    </script>
@stop
