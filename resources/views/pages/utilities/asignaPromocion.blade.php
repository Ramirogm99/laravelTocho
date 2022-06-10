@php
date_default_timezone_set('Europe/Madrid');
$time = strtotime(now());
@endphp

{{-- Extiende de la plantilla --}}
@extends('adminlte::page')

{{-- Titulo de la ventana --}}
@section('title', 'Asignación de promociones')

{{-- Cabecera de la pagina --}}
@section('content_header')

    <h1>Asignación de vallas a la promoción: {{$promocion->nombre}}</h1>
@stop



{{-- Contenido de la página --}}
@section('content')
    <div class="form-check">
        <form action="{{ url('promociones/updateVallasPromocion')}}" method="post">
            @csrf
            <input type="hidden" name="promocion" value="{{$promocion->id}}">
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

                                                <th style="text-align: center; vertical-align: middle;" data-field="SelectALL"><input class="form-check-input mx-auto"
                                                        type="checkbox" value="" id="selectAll" /><label
                                                        class="form-check-label ml-4" for="flexCheckDefault">
                                                        Asignada
                                                    </label></th>
                                                <th style="text-align: center; vertical-align: middle;" data-field="Cliente">Valla</th>
                                                <th style="text-align: center; vertical-align: middle;" data-field="Inicio">Dirección</th>
                                                <th style="text-align: center; vertical-align: middle;" data-field="Imagen">Imagen</th>
                                                <th style="text-align: center; vertical-align: middle;" data-field="Acciones" id="acciones" class="max-width:100px">Acciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $index = 0; ?>
                                            @foreach ($vallas as $valla)
                                                {{-- Calculo del numero de dias restantes --}}

                                                

                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><input class="form-check-input mx-auto" name="checked[]"
                                                            type="checkbox" value="{{ $valla->id }}" {{$valla->check?'checked':''}}
                                                            id="flexCheckDefault" /><label class="form-check-label"
                                                            for="flexCheckDefault" ></td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $valla->alias }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $valla->direccion }}</td>

                                                    

                                                    <td style="text-align: center; vertical-align: middle;"> <img id="pic{{ $index }}" style="width:130px; height=80px;"
                                                        src="@if(isset($valla->norte) && $valla->norte!=""){{ url('') }}/public/storage/{{@$valla->alias}}/{{ @$valla->norte }} @else {{ url('') }}/public/storage/saile1.jpg @endif"
                                                        data-target="#fotoModal{{$index}}" data-toggle="modal">
                                                    </td>

                                                {{-- modal para mostrar la foto --}}
                                                

                                                    <td style="text-align: center; vertical-align: middle;">
                                                        {{-- BOTONES DE ACCION --}}
                                                        <a href='{{ url('') }}/vallas/show/{{ $valla->id }}'
                                                            class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>

                                                        <a href="{{ url('') }}/vallas/edit/{{ $valla->id }}"
                                                            class='btn btn-sm btn-info'><i
                                                                class="fas fa-pencil-alt"></i></a>

                                                        {{-- Boton borrar que envia a un modal --}}

                                                    </td>
                                                </tr>
                                                <?php $index++; ?>
                                            @endforeach

                                            @for ($i = 0; $i < $index; $i++)
                                                <div class="modal fade" id="fotoModal{{$i}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                
                                                                {{ $vallas[$i]->alias }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                            <div class="modal-body">
                                                                <img src="@if(isset($vallas[$i]->norte) && $vallas[$i]->norte!="") {{ url('') }}/public/storage/{{$vallas[$i]->alias}}/{{ $vallas[$i]->norte }} @else {{ url('') }}/public/storage/saile1.jpg @endif"
                                                                    alt="{{ $valla->alias }}" style="width:100%">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <div class="card-footer mx-auto">
                                          
                                            <button type="submit" class="btn btn-primary " id="maquetar" > Actualizar vallas promocion </button>
                                         
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

    <script async>
        $(document).ready(function() {
            $('#tablacontratos').DataTable({
                "lengthMenu": [ 200, 20, 50, 100, 500, 1000 ],
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
                columnDefs: [{
                    "orderable": false,
                    "targets": 0
                }],
                aaSorting: [
                    [1, 'asc']
                ],

            });
        })

        let selectall = document.getElementById('selectAll');
        let checks = document.querySelectorAll("input[type=checkbox]");
        let maquetar = document.getElementById('maquetar')


        selectall.addEventListener('click', function() {
            checks.forEach(check => {
                if (check.checked) {
                    check.checked = false;
                    selectall.checked = false;
                } else {
                    check.checked = true;
                    selectall.checked = true;
                }
            })
        });

       
    </script>

@stop