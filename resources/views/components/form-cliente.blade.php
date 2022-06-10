<section class="content">
    <div class="box">
        <div class="box-header">

        </div>
        <input type="hidden" id="urlapp" value="http://localhost/alquiler/">


        <div class="box-body">

            @if ($modo == 'update')
                <form action='{{ url("clientes/update/$cliente->id") }}' class="my_form row"
                    enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @elseif($modo == 'create')
                    <form action="{{ url('clientes/insert') }}" class="my_form row" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8">
                    @else
                        <form action='' class="my_form row" enctype="multipart/form-data" method="post"
                            accept-charset="utf-8">
            @endif

            @csrf
            <input type="hidden" name="token" value="b2697287">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">General</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body row">

                        <div class="form-group col-md-8">
                            <label for="nombre">Nombre*</label> <input type="text" name="nombre"
                                value="{{ $cliente ? $cliente->nombre : '' }}" id="nombre"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }}>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="username">Denominación Social*</label> <input type="text" name="d_social"
                                value="{{ $cliente ? $cliente->d_social : '' }}" id="username"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }}>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="direccion">Dirección*</label> <input type="text" name="direccion"
                                value="{{ $cliente ? $cliente->direccion : '' }}" id="direccion"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }}>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="poblacion">Localidad</label> <input type="text" name="localidad"
                                value="{{ $cliente ? $cliente->localidad : '' }}" id="localidad"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }}>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="provincia">Provincia</label> <input type="text" name="provincia"
                                value="{{ $cliente ? $cliente->provincia : '' }}" id="provincia"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }}>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="codpost">Código postal</label> <input type="text" name="codpost"
                                value="{{ $cliente ? $cliente->codpost : '' }}" id="codpost"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }} maxlength="5">
                        </div>
                        {{-- EMAIL --}}
                        <div class="form-group col-md-4">
                            <label for="email">Email</label> <input type="email" name="email"
                                value="{{ $cliente ? $cliente->email : '' }}" id="email"
                                class="form-control input-lg  " {{ $modo == 'show' ? 'readonly' : '' }} required
                                pattern='^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}$'>
                        </div>
                        @if($mode == "show")
                        <div class="form-group col-md-4">
                            <label for="provincia">Representante</label> <input type="text" name="representante"
                                value="{{ $cliente ? $cliente->representante : '' }}" id="representante"
                                class="form-control input-lg " readonly>
                        </div>
                        @endif


                        <div class="form-group col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
   
    <div class="col-12">
        @if($modo == 'show')
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Historial de Contratos</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive border border-light m-1 p-2 rounded shadow-lg table-hover">
                    <div class="text-center mb-3">
                        <h3 class=" border border-light shadow w-25 m-auto rounded" style="background-color:rgb(176, 253, 253)"><b>VIGENTES</b></h3>
                    </div>
                    <table id="tablacontratos" style="width:100%; border: 0;"
                        class="table table-hover table-striped table-bordered table-sm display">
                    <tr>
                        <th data-field="Contrato" class="text-center">Contrato</th>
                        <th data-field="Fin" class="text-center">Fecha de Inicio</th>
                        <th data-field="Fin" class="text-center" style="width: 25%">Fecha de Finalización</th>
                        <th data-field="Activo" class="text-center">Activo</th>
                        <th data-field="Activo" class="text-center">Acciones</th>
                    </tr>
               @foreach($contratos as $contrato)
                    @if($contrato->baja==0)
                    <tr>
                        <td class="text-center">{{$contrato->id}}</td>
                        <td class="text-center">{{date('d / m / Y', strtotime($contrato->f_inicio))}}</td>
                        <td class="text-center">{{date('d / m / Y', strtotime($contrato->f_fin))}}</td>
                        <td class="text-center"> @if($contrato->f_inicio <= date('Y-m-d') && $contrato->f_fin >= date('Y-m-d')) Si @else No @endif</td>
                        <td class="text-center"> <a href='{{ url('') }}/contratos/show/{{ $contrato->id }}'
                            class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a> </td>
                    </tr>
                    @endif

               
               @endforeach
                </table>
                </div>

                <div class="table-responsive border border-light mt-4 m-1 p-2 rounded shadow-lg">
                    <div class="text-center mb-3">
                        <h3 class="border border-light rounded shadow w-25 m-auto" style="background-color:rgb(176, 253, 253)"><b>ANTERIORES</b></h3>
                    </div>
                    <table id="tablacontratos" style="width:100%; border: 0;"
                        class="table table-hover table-striped table-bordered table-sm display">
                    <tr>
                        <th data-field="Contrato" class="text-center">Contrato</th>
                        <th data-field="Fin" class="text-center">Fecha de Inicio</th>
                        <th data-field="Fin" class="text-center" style="width: 25%">Fecha de Finalización</th>
                        <th data-field="Activo" class="text-center">Activo</th>
                        <th data-field="Activo" class="text-center">Acciones</th>
                    </tr>
               @foreach($contratos as $contrato)
                    @if($contrato->baja==1)
                    <tr>
                        <td class="text-center">{{$contrato->id}}</td>
                        <td class="text-center">{{$contrato->f_inicio}}</td>
                        <td class="text-center">{{$contrato->f_fin}}</td>
                        <td class="text-center"> En Baja</td>
                        <td class="text-center"> <a href='{{ url('') }}/contratos/show/{{ $contrato->id }}'
                            class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a> </td>
                    </tr>
                    @endif

               
               @endforeach
                </table>
                </div>


            </div>
        </div>
        @endif



        <div class="card card-primary">
            <div class="card-footer">
                <a href="{{ url('clientes') }}" class="btn btn-secondary float-left">Volver</a>
                @if ($modo != 'show')
                    <button type="button" name="mysubmit" data-toggle="modal" data-target="#modalmessage"
                        class="btn btn-primary float-right">Guardar</button>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de inserción/actualización
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea realizar la operación? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>
    </div>
</section>
