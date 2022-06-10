@extends('adminlte::page')

@section('title', 'Email')

@section('content_header')
    <h1>Email</h1>
@stop

@section('content')
    <form action="{{ url('mail/enviar') }}" method="post">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

        <div class="col-12">
            <div class="card card-primary card-outline">

                {{-- CABECERA DEL FORMULARIO DEL EMAIL --}}
                <div class="card-header">
                    <h3 class="card-title">Editor de e-mail</h3>
                </div>
                <div class="card-body">
                    <div class='row'></div>
                    <div class="form-group col-6">
                        <label for="cliente">Seleccione al cliente: </label>
                        <select class="form-select col-6" aria-label="Default select example" name="cliente" id='cliente'
                            required>
                            <option selected></option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-10">
                        <label for="exampleFormControlTextarea1">Cabecera del email: </label>
                        <textarea class="form-control" name="texto" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group col-10">
                        <div class="table-responsive">
                            <table id="tablamail" style="width:100%; border: 0;"
                                class="table table-hover table-striped table-bordered table-sm ">
                                <thead class="thead-tabla">
                                    <tr>
                                        <th data-target="alias">Nombre de la valla</th>
                                        <th data-target="direccion">Dirección</th>
                                        <th data-target="Acciones">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vallas as $valla)
                                        <tr>
                                            <td>{{ $valla->alias }}</td>
                                            <td>{{ $valla->direccion }}</td>
                                            <td>
                                                <input type="hidden" name="vallas[]" value='{{ $valla->id }}'>

                                                {{-- BOTONES DE ACCION --}}
                                                <a href='{{ url('') }}/vallas/show/{{ $valla->id }}'
                                                    class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button id='enviar' type="submit" class="btn btn-primary float-right">
                        Previsualización
                    </button>
                </div>
            </div>

        </div>

        </div>

    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


    <script async>
        $(document).ready(function() {
            $('#tablamail').DataTable({
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
