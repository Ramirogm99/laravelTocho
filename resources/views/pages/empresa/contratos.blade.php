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
    <h1>Contratos</h1>
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

                                        <th data-field="Cliente" class="text-center">Cliente</th>
                                        <th data-field="Fecha" class="text-center">Vallas</th>
                                        <th data-field="Precio" class="text-center">Precio Total</th>
                                        <th data-field="Inicio" class="text-center">Inicio</th>
                                        <th data-field="Fin" class="text-center">Fin</th>
                                        <th data-field="Estado" class="text-center">Restante</th>
                                        <th data-field="Acciones" id="acciones" class="max-width:100px text-center"">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @foreach ($contratos as $contrato)
                                            {{-- Calculo del numero de dias restantes --}}
                                            @php
                                                
                                                $fin = strtotime($contrato->f_fin);
                                                $inicio = strtotime($contrato->f_inicio);
                                                
                                                // Si el contrato esta activo
                                                if ($inicio <= $time) {
                                                    $restante = $fin - $time;
                                                    $dias = floor($restante / (60 * 60 * 24)) . ' dias';
                                                    if ($dias < 10 && $dias >= 0) {
                                                        $dias = '0' . $dias;
                                                    } elseif ($dias < 0) {
                                                        $dias = 'Expirado';
                                                    }
                                                
                                                    // Si el contrato aun no ha empezado
                                                } else {
                                                    $dias = 'En reserva';
                                                }
                                                
                                                //Formateo de fechas de inicio y de fin
                                                $f_inicio = date('d / m / Y', $inicio);
                                                $f_fin = date('d / m / Y', $fin);
                                                
                                            @endphp

                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ DB::table('clients')->where('id', $contrato->id_cliente)->first()->nombre }}
                                        </td>
                                        <td
                                            style="text-align: center; vertical-align: middle; display: flex; flex-direction:row; justify-content: center;  padding-top: 19px">
                                            @foreach ($contrato->vallas as $valla)
                                                @php
                                                    $material = $valla->material;
                                                    
                                                    $tipo = $material->tipo;
                                                @endphp

                                                @if ($tipo == 'Lona')
                                                    <p style="
                                                            display:inline-block;
                                                            height:20px;
                                                            width:20px;
                                                            border-radius:50%;
                                                            background-color: lightblue">
                                                    </p>
                                                @elseif ($tipo == 'Vinilo')
                                                    <p style="
                                                            background-color: purple;
                                                            clip-path: polygon(50% 0, 100% 100%, 0 100%);
                                                            width: 20px;
                                                            height: 20px;">
                                                    </p>
                                                @elseif ($tipo == 'Carton')
                                                    <p style="
                                                            background-color: #c78769;
                                                            clip-path: polygon(0% 0, 100% 100%, 100 100%);
                                                            width: 20px;
                                                            height: 20px;">
                                                    </p>
                                                @endif
                                                ㅤ
                                            @endforeach
                                        </td>


                                        <td style="text-align: center; vertical-align: middle;">{{ $contrato->precio }} €
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $f_inicio }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $f_fin }}</td>
                                        {{-- Estado con colores --}}
                                        <td id="restante"
                                            style="display: flex; flex-direction:row; justify-content: space-evenly; text-align: center; padding-top: 19px">
                                            <p>{{ $dias }}</p>
                                            <p style="background-color:blue;
                                                                    display:inline-block;
                                                                    height:20px;
                                                                    width:20px;
                                                                    border-radius:50%;
                                                                    "
                                                @if ($dias < 5) class="bg-danger" @elseif ($dias < 15) class="bg-warning" @elseif ($dias == 'En reserva') class="bg-info" @else class="bg-success" @endif>
                                                ㅤ </p>
                                        </td>
                                        <td class="pt-3" style="text-align: center;">
                                            {{-- BOTONES DE ACCION --}}
                                            <a href='{{ url('') }}/contratos/rellenarContrato/{{ $contrato->id }}'
                                                class='btn btn-sm btn-dark'><i class="fas fa-file-pdf"></i></a>
                                            
                                            <a href='{{ url('') }}/contratos/show/{{ $contrato->id }}'
                                                class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>
                                            
                                            <a href="{{ url('') }}/contratos/edit/{{ $contrato->id }}"
                                                class='btn btn-sm btn-info'><i class="fas fa-pencil-alt"></i></a>

                                            {{-- Boton borrar que envia a un modal --}}
                                            <button class="btn btn-sm btn-danger delete-button" data-toggle="modal"
                                                data-target="#modalmessage" data-val="{{ $contrato->id }}"><i
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
                    @if (isset($contrato))
                        <a href="{{ url('') }}/contratos/delete/{{ $contrato->id }}"
                            class='btn btn-danger'>Eliminar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Alertas modales --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session()->has('contratosucc1'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El contrato ha sido dado de alta con exito',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('contratosucc1');
        @endphp
    @endif
    @if (session()->has('contratosucc2'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El contrato ha sido actualizado con exito',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('contratosucc2');
        @endphp
    @endif
    @if (session()->has('contratosucc3'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El contrato ha sido dado de baja con exito',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('contratosucc3');
        @endphp
    @endif
    @if (session()->has('contracterr1'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al crear el contrato',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('contracterr1');
        @endphp
    @endif

    @if (session()->has('contracterr2'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al actualizar el contrato',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('contracterr2');
        @endphp
    @endif

    @if (session()->has('contracterr3'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al dar de baja al contrato',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('contracterr3');
        @endphp
    @endif
    {{-- Estas son las alertas --}}

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
                    },
                    "toolbar": {
                        "search": "Buscar",
                        "print": "Imprimir",
                        "reset": "Reiniciar",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                },
                dom: '<"toolbar"frtip> Bfrtip ',
                buttons: [{
                    // Boton para añadir usuario (Posteriormente añadir a dentro de la tabla)
                    text: '<i class="fa-solid fa-plus"></i>',
                    action: () => {
                        window.location.href = "{{ url('/contratos/crearContrato') }}";
                    }
                }],
                

                
            });
            $("div.toolbar").html('<spam class="d-flex"><p style="display:inline-block;height:20px;width:20px;border-radius:50%;background-color: lightblue"></p> <p class="mx-2"> Lona </p><p style="background-color: purple;clip-path: polygon(50% 0, 100% 100%, 0 100%);width: 20px;height: 20px;"></p><p class="mx-2"> Vinilo </p><p style=" background-color: #c78769;clip-path: polygon(0% 0, 100% 100%, 100 100%);width: 20px;height: 20px;"></p><p class="mx-2"> Carton </p></spam>');
            $(".dt-button").addClass('btn btn-primary ml-3 float-right');
            $(".dt-button").css("width", "100px");

            // Codigo js para pasar el id del usuario seleccionado al modal para su posterior eliminacion
            $(".delete-button").click(function() {
                var id = $(this).attr("data-val");
                $('#modalmessage').find("a").first().attr("href", "{{ url('') }}/contratos/delete/" +
                    id);


            });
        });
    </script>
@stop
