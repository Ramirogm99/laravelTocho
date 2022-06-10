@extends('adminlte::page')

@section('title', 'Ocupaciones')

@section('content_header')
    <h1>Ver ocupaciones</h1>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@stop


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="tablaclientes" style="width:100%; border: 0;"
                                class="table table-hover table-striped table-bordered table-sm">
                                <thead class="thead-tabla">
                                    <tr>
                                        <th data-field="NombreValla" class="text-center">Nombre de la valla</th>
                                        <th data-field="Cliente" class="text-center">Cliente</th>
                                        <th data-field="Numero" class="text-center">Nº de contrato</th>
                                        <th data-field="Fecha_ini" class="text-center">Fecha de inicio</th>
                                        <th data-field="Fecha_fin" class="text-center">Fecha de finalización</th>
                                        <th data-field="Acciones" id="acciones" class="max-width:100px text-center">Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    @foreach ($vallas as $valla)
                                        <tr class="tr" id="">
                                            <td style="text-align: center; vertical-align: middle;">{{ $valla->alias }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $valla->nombre }}
                                            </td>
                                            {{-- No usar nombres confusos, esto es la id del contrato y no de la valla --}}
                                            <td style="text-align: center; vertical-align: middle;">{{ $valla->id }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $valla->f_inicio }}
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $valla->f_fin }}</td>
                                            <td style="text-align: center; vertical-align: middle;">

                                                {{-- BOTONES DE ACCION --}}
                                                <a href='{{ url('') }}/contratos/show/{{ $valla->id }}'
                                                    class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>

                                                <a href="{{ url('') }}/contratos/edit/{{ $valla->id }}"
                                                    class='btn btn-sm btn-info'><i class="fas fa-pencil-alt"></i></a>
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
@section('js')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


    <script async>
        $(document).ready(function() {
            $('#tablaclientes').DataTable({
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
                dom: 'Bfrtip',
                buttons: [],
                columnDefs: [{
                    targets: 2,
                    className: "truncate",
                    targets: 5,
                    className: "actions"
                }]

            });

        });
    </script>

@stop
