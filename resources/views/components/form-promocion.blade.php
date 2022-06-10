<section class="content">
    <div class="box">
        <div class="box-header">

        </div>
        <input type="hidden" id="urlapp" value="http://loscalhost/alquiler/">

        
        <div class="box-body">

            @if ($modo == 'update')
                <form action='{{ url("promociones/update/$promocion->id") }}' class="my_form row"
                    enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @elseif($modo == 'create')
                    <form action="{{ url('promociones/insert') }}" class="my_form row" enctype="multipart/form-data"
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
                        <h3 class="card-title text-bold">General</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body row">

                        <div class="form-group col-md-8">
                            <label for="nombre">Promocion*</label> <input type="text" name="nombre"
                                value="{{ $promocion ? $promocion->nombre : '' }}" id="nombre"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }} required>                                                                                           
                        </div> 
                        
                        <div class="form-group col-md-4">
                            <label for="color">Color*</label> <input type="color" name="color"
                                value="{{ $promocion ? $promocion->color : '' }}" id="username"
                                class="form-control input-lg " {{ $mode == 'show' ? 'disabled' : '' }} required>
                        </div>


                        <div class="form-group col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    </div>

    {{-- LISTADO DE CONTRATOS --}}
    @if($modo != "create" && $modo != "update")
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                
                <h3 class="card-title text-bold">Listado de contratos con promocion "{{$promocion->nombre}}"</h3>
              
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                        data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>

            {{-- @php
                dd($contratos)    
            @endphp --}}
            
            <div class="card-body row justify-content-center">

                @foreach ($contratos as $contrato)
                
                    <div class="card card-primary border round shadow col-11">
                        <div class="card-body">
                            <table id="tabla-contratos" class="table table-bordered table-striped">
                                <thead >
                                    <tr>
                                        <th class="col-2 text-center">Nº CONTRATO</th>
                                        <th class="col-4 text-center">CLIENTE</th>
                                        <th class="col-4 text-center">VALLA</th>
                                        <th class="col-2 text-center">FOTO VALLA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center align-middle">{{$contrato->contrato_id}}</td>
                                        <td class="text-center align-middle">{{$contrato->nombre_cliente}}</td>
                                        <td class="text-center align-middle">{{$contrato->alias}}</td>
                                        <td class="text-center align-middle"><img src="{{ url('') }}/public/storage/{{ $contrato->foto }}" width="200px"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                @endforeach
            </div>
            


            
                <div class="form-group col-md-4">
                    </div>
            </div>
        </div>
        
    </div>
    @endif
    </div>
    <div class="col-12">

        <div class="card card-primary">
            <div class="card-footer">
                <a href="{{ url('promociones') }}" class="btn btn-secondary float-left">Volver</a>
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