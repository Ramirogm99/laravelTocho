{{-- ESTRUCTURA PAGINA DE CLIENTE --}}

@extends('adminlte::page')

@section('title', 'Clientes')


@section('content_header')
    <h1>Clientes</h1>
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
                                        <th data-field="Nombre" class="text-center">Nombre</th>
                                        <th data-field="Direccion" class="text-center">Dirección</th>
                                        <th data-field="Localidad" class="text-center">Localidad</th>
                                        <th data-field="Provincia" class="text-center">Provincia</th>
                                        <th data-field="Email" class="text-center">Email</th>
                                        <th data-field="Acciones" id="acciones" class="max-width:100px text-center">Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    @foreach ($clientes as $cliente)
                                        <tr class="tr" id="{{ $cliente->id }}">
                                            <td style="text-align: center; vertical-align: middle;">{{ $cliente->d_social }}
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {{ $cliente->direccion }}</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {{ $cliente->localidad }}</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {{ $cliente->provincia }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $cliente->email }}
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {{-- BOTONES DE ACCION --}}
                                                <a href='{{ url('') }}/clientes/show/{{ $cliente->id }}'
                                                    class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>

                                                <a href="{{ url('') }}/clientes/edit/{{ $cliente->id }}"
                                                    class='btn btn-sm btn-info'><i class="fas fa-pencil-alt"></i></a>

                                                <button class="btn btn-sm btn-danger delete_button" data-toggle="modal"
                                                    data-bs-whatever="{{ $cliente->id }}" data-target="#modalmessage"> <i
                                                        class="fas fa-trash-alt"></i>
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


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session()->has('succ1'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El cliente ha sido creado con exito',
            })
        </script>
        @php
            session()->forget('succ1');
        @endphp
    @endif
    @if (session()->has('succ2'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El cliente ha sido actualizado con exito',
            })
        </script>
        @php
            session()->forget('succ2');
        @endphp
    @endif
    @if (session()->has('succ3'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El cliente ha sido borrado con exito',
            })
        </script>
        @php
            session()->forget('succ3');
        @endphp
    @endif
    @if (session()->has('error1'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al crear el cliente',
            })
        </script>
        @php
            session()->forget('error1');
        @endphp
    @endif
    @if (session()->has('error2'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al actualizar el cliente',
            })
        </script>
        @php
            session()->forget('error2');
        @endphp
    @endif
    @if (session()->has('error3'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al borrar el cliente',
            })
        </script>
        @php
            session()->forget('error3');
        @endphp
    @endif

    {{-- MODAL BOOTSTRAP --}}

    <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de operación de borrado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> ¿Está seguro de que desea eliminar los datos?</p>
                    <p>Esta operación no puede deshacerse </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="" id="modal_url" class='btn btn-danger'>Eliminar</a>
                </div>
            </div>
        </div>
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        .truncate {
            width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .actions {
            width: 100px;
        }

    </style>


@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script async>
        $(document).ready(function() {
            $(".delete_button").click(function() {
                var id = $(this).attr("data-bs-whatever");
                $('#modalmessage').find("a").first().attr("href", "{{ url('') }}/clientes/delete/" +
                    id);


            });

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
                buttons: [{
                    text: '<i class="fa-solid fa-plus"></i>',
                    action: () => {
                        window.location.href = "{{ url('/clientes/clienteform') }}";
                    }
                }],

                columnDefs: [{
                    targets: 2,
                    className: "truncate",
                    targets: 5,
                    className: "actions"
                }]

            });
            $(".dt-button").addClass('btn btn-primary ml-3 float-right');
            $(".dt-button").css("width", "100px");

            // Accion para poder pasar al modal el id del elemento seleccionado para posteriormente borrar


        });
    </script>
@stop
