{{-- ESTRUCTURA PAGINA DE USUARIOS --}}

@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class=" ">Usuarios</h1>
    {{-- MENSAJE PARA POSTERIOR ALERTA --}}
    @if (isset($mensaje) && isset($tipo) && !empty($mensaje))
        <div class="alert alert-success" role="alert">
            {{ $mensaje }}
        </div>
    @endif
@stop


@if (Auth::user()->auth_level > 7)

    @section('content')
        {{-- TABLA DE MUESTRA DE TODOS LOS USUARIOS --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="tablausuarios" style="width:100%; border: 0;"
                                    class="table table-hover table-striped table-bordered table-sm display">
                                    <thead class="thead-tabla">
                                        <tr>
                                            <th data-field="Usuario" class="text-center">#</th>
                                            <th data-field="Name" class="text-center">Nombre</th>
                                            <th data-field="Nivel usuario" class="text-center">Nivel usuario</th>
                                            <th data-field="Avatar" class="text-center">Avatar</th>
                                            <th data-field="Estado" class="text-center">Estado</th>
                                            <th data-field="Acciones" id="acciones" class="max-width:100px text-center">
                                                Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            @if ($usuario->auth_level < Auth::user()->auth_level || $usuario->id != Auth::user()->id)
                                                {{-- Si el usuario esta eliminado no se muestra en la tabla --}}
                                                @if ($usuario->borrado != 1)
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            {{ $usuario->id }}</td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            {{ $usuario->name }}</td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            @if ($usuario->auth_level == 3)
                                                                Usuario
                                                            @elseif ($usuario->auth_level == 7)
                                                                Gerente
                                                            @elseif($usuario->auth_level == 1)
                                                                Cliente
                                                            @else
                                                                Administrador
                                                            @endif
                                                        </td>
                                                        <td style="text-align: center"> <img
                                                                src="storage\{{ $usuario->avatar }}"
                                                                style="max-width: 100px; max-height:100px;"> </td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            @if ($usuario->bloqueado == 0)
                                                                <p style="background-color: lightgreen">Activo</p>
                                                            @elseif ($usuario->bloqueado == 1)
                                                                <p style="background-color:lightcoral">Bloqueado</p>
                                                            @endif
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            {{-- BOTONES DE ACCION --}}
                                                            <a href='{{ url('') }}/usuarios/show/{{ $usuario->id }}'
                                                                class='btn btn-sm btn-dark'><i
                                                                    class="fas fa-eye"></i></a>

                                                            <a href="{{ url('') }}/usuarios/edit/{{ $usuario->id }}"
                                                                class='btn btn-sm btn-info'><i
                                                                    class="fas fa-pencil-alt"></i></a>

                                                            {{-- Boton borrar que envia a un modal --}}
                                                            <button class="btn btn-sm btn-danger delete-button"
                                                                data-toggle="modal" data-target="#modalmessage"
                                                                data-val="{{ $usuario->id }}"><i
                                                                    class="fas fa-trash-alt"></i>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL LANZADO AL TRATAR DE ELIMINAR --}}

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
                        <p></p>
                        <a href="{{ url('') }}/usuarios/delete/{{ $usuario->id }}"
                            class='btn btn-danger'>Eliminar</a>
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
                    text: 'El usuario ha sido creado con exito',
                    timer: 2000,
                    showConfirmButton: false,
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
                    text: 'El usuario ha sido actualizado con exito',
                    timer: 2000,
                    showConfirmButton: false,
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
                    text: 'El usuario ha sido eliminado con exito',
                    timer: 2000,
                    showConfirmButton: false,
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
                    text: 'Hubo un problema al crear el usuario',
                    timer: 2000,
                    showConfirmButton: false,
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
                    text: 'Hubo un problema al actualizar el usuario',
                    timer: 2000,
                    showConfirmButton: false,
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
                    text: 'Hubo un problema al eliminar el usuario',
                    timer: 2000,
                    showConfirmButton: false,
                })
            </script>
            @php
                session()->forget('error3');
            @endphp
        @endif

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
                $('#tablausuarios').DataTable({
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
                    buttons: [
                        // 'copy', 'csv', 'excel', 'pdf', 'print'
                        {

                            // Boton para añadir usuario (Posteriormente añadir a dentro de la tabla)
                            text: ' <i class="fa-solid fa-plus"></i>',
                            action: () => {
                                window.location.href = "{{ url('/usuarios/usuarioform') }}";
                            }
                        }
                    ]
                });
                $(".dt-button").addClass('btn btn-primary ml-3 float-right');
                $(".dt-button").css("width", "100px");




                // Codigo js para pasar el id del usuario seleccionado al modal para su posterior eliminacion
                $(".delete-button").click(function() {
                    var id = $(this).attr("data-val");
                    $('#modalmessage').find("a").first().attr("href", "{{ url('') }}/usuarios/delete/" +
                        id);


                });
            });
        </script>
    @stop
@else
    @section('content')
        <p>No tiene permisos para ver los datos de esta página</p>
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
    @stop


@endif
