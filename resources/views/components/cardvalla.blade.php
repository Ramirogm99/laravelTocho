<?php
// {{-- CADA UNA DE LAS CARTAS QUE VA A CONTENTER LA INFORMACION DE LAS VALLAS, ES EL FORMULARIO GENERICO --}}
$char = '@';
?>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>

<div class="card shadow p-3 mb-5 bg-white rounded claseFiltro">
    <div class="card-body ">

        {{-- Si entra en modo crear: --}}
        @if ($modo == 'create')
            <form id="modal-details" action='{{ url('vallas/insert') }}' enctype="multipart/form-data" method="post"
                accept-charset="utf-8">
                @csrf

                {{-- Modo update --}}
            @elseif($modo == 'update')
                <form id="modal-details" action='{{ url("vallas/update/$valla->id") }}' enctype="multipart/form-data"
                    method="post" accept-charset="utf-8">
                    @csrf

                    {{-- Modo eliminar --}}
                @else
                    <form action='{{ url("vallas/delete/$valla->id") }}' enctype="multipart/form-data" method="get"
                        accept-charset="utf-8">
        @endif


        <div class="row">
            {{-- DIV QUE CONTIENE LA IMAGEN DE LA VALLA --}}
            {{-- preview --}}
            @if ($modo != 'create' && $modo != 'update' && $modo != 'showonly')


                <div id="carouselExampleControls{{ $valla->id }}"
                    class="carousel slide col-5 w-400 h-360 m-3 overflow-hidden border rounded border shadow p-3"
                    style=" overflow:hidden; padding:0; position: relative" data-interval="false">

                    @if (property_exists($valla, 'norte'))

                        <ol class="carousel-indicators rounded border shadow ">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active bg-info">
                            </li>

                            @if (property_exists($valla, 'sur'))
                                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active bg-info">
                                </li>
                            @endif
                            @if (property_exists($valla, 'este'))
                                <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active bg-info">
                                </li>
                            @endif
                            @if (property_exists($valla, 'oeste'))
                                <li data-target="#carouselExampleIndicators" data-slide-to="3" class="active bg-info">
                                </li>
                            @endif

                        </ol>

                    @endif


                    <div class="carousel-inner">

                        {{-- SI LA VALLA TIENE FOTOGRAFIAS --}}


                        @if (property_exists($valla, 'norte'))
                            <div class="carousel-item active">
                               
                                <img class="logo m-2"
                                    src="@if (isset($valla->norte) && $valla->norte != ""){{ url('') }}/public/storage/{{@$valla->alias}}/{{ @$valla->norte }} @else {{ url('') }}/public/storage/saile1.jpg @endif"
                                    style="object-fit: contain;  width:500px; height: 350px; margin: 0 auto;">


                            </div>

                            <div class="carousel-item">

                                <img class="logo"
                                    src=" @if (isset($valla->sur) && $valla->sur != "") {{ url('') }}/public/storage/{{@$valla->alias}}/{{ @$valla->sur }} @else {{ url('') }}/public/storage/saile1.jpg @endif"
                                    style="object-fit: contain; width:500px; height: 350px; margin: 0 auto; ">

                            </div>

                            <div class="carousel-item">

                                <img class="logo"
                                    src="@if (isset($valla->este) && $valla->este != "") {{ url('') }}/public/storage/{{@$valla->alias}}/{{ @$valla->este }} @else {{ url('') }}/public/storage/saile1.jpg @endif"
                                    style="object-fit: contain; width:500px; height: 350px; margin: 0 auto;">

                            </div>

                            <div class="carousel-item">

                                <img class="logo"
                                    src="@if (isset($valla->oeste) && $valla->oeste != "") {{ url('') }}/public/storage/{{@$valla->alias}}/{{ @$valla->oeste }} @else {{ url('') }}/public/storage/saile1.jpg @endif"
                                    style="object-fit: contain; width:500px; height: 350px; margin: 0 auto;">

                            </div>



                            {{-- SI LA VALLA NO TIENE FOTOGRAFIAS --}}
                        @else
                            <div class="carousel-item active">
                                <img id="norte" class="logo"
                                    src="{{ url('') }}/public/storage/saile1.jpg"
                                    style="object-fit: contain;  max-width:500px; max-height: 400px; margin: 0 auto;">

                            </div>
                        @endif
                    </div>

                    @if (property_exists($valla, 'norte'))

                        {{-- Controles de la imagen --}}
                        @if ($modo != 'update')
                            <a class="carousel-control-prev" href="#carouselExampleControls{{ $valla->id }}"
                                role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                        @endif

                        <a class="carousel-control-next" href="#carouselExampleControls{{ $valla->id }}"
                            role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        {{-- Fin controles de la imagen --}}

                    @endif


                </div>
            @elseif($modo == 'create' || $modo == 'update' || $modo == 'showonly')
                {{-- DIV QUE CONTIENE LA IMAGEN DE LA VALLA --}}
                {{-- preview --}}

                <div id="contenedor" class="col-4 h-360 overflow-hidden " style=" overflow:hidden; position: relative">
                    {{-- Imagen de la valla --}}
                    <div class="border rounded shadow mb-2 pt-2" style="position: relative">
                        <div class="border rounded shadow m-2" style="width:35px; position:absolute; z-index:99">
                            <img src="{{ url('') }}/public/storage/cardinals/north.png"">
                        </div>
                    <img id="norte"
                                src="{{ url('') }}\public\storage\{{ @$valla->norte ? @$valla->norte : 'saile1.jpg' }}"
                                style="object-fit: contain;  width:465px; max-height: 200px; margin: 0 auto; margin-bottom:10px;">
                        </div>

                        <div class="border rounded shadow mb-2 pt-2" style="position: relative">
                            <div class="border rounded shadow m-2" style="width:35px; position:absolute; z-index:99">
                                <img src="{{ url('') }}/public/storage/cardinals/south.png">
                            </div>
                            <img id="sur"
                                src="{{ url('') }}\public\storage\{{ @$valla->sur ? @$valla->sur : 'saile1.jpg' }}"
                                style="object-fit: contain;  width:465px; max-height: 200px; margin: 0 auto; margin-bottom:10px;">
                        </div>

                        <div class="border rounded shadow mb-2 pt-2" style="position: relative">
                            <div class="border rounded shadow m-2" style="width:40px; position:absolute; z-index:99">
                                <img src="{{ url('') }}/public/storage/cardinals/east.png">
                            </div>
                            <img id="este"
                                src="{{ url('') }}\public\storage\{{ @$valla->este ? @$valla->este : 'saile1.jpg' }}"
                                style="object-fit: contain;  width:465px; max-height: 200px; margin: 0 auto; margin-bottom:10px;">

                        </div>

                        <div class="border rounded shadow mb-2 pt-2" style="position: relative">
                            <div class="border rounded shadow m-2" style="width:40px; position:absolute; z-index:99">
                                <img src="{{ url('') }}/public/storage/cardinals/west.png">
                            </div>

                            <img id="oeste"
                                src="{{ url('') }}\public\storage\{{ @$valla->oeste ? @$valla->oeste : 'saile1.jpg' }}"
                                style="object-fit: contain;  width:465px; max-height: 200px; margin: 0 auto; margin-bottom:10px;">
                        </div>

                    </div>
            @endif

            @if ($modo != 'show')
                {{-- Parte de la derecha de la imagen valla --}}
                <div class="col mx-3">

                    {{-- Parte superior de la carta --}}

                    <div class="d-flex flex-row">

                        {{-- Por si queremos hacer un boton modal de borrar las vallas --}}

                        {{-- @if ($modo == 'update')
                            <button type="button" class="btn btn-danger btn-sm"
                                style="margin-top: 35px; margin-bottom:5px" data-toggle="modal"
                                data-target="#modal-delete-{{ $valla->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button> --}}

                        {{-- modal para eliminar --}}

                        {{-- <div class="modal fade" id="modal-delete-{{ $valla->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="margin-top:15%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-delete-{{ $valla->id }}">
                                                {{ __('Eliminar imagen') }}
                                            </h6>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="py-3 text-center">
                                                <i class="fas fa-trash fa-3x"></i>
                                                <h4 class="heading mt-4">{{ __('¿Estas seguro?') }}</h4>
                                                <p>{{ __('¿Estas seguro de que quieres eliminar las imagenes? Habra que introducirlas posteriormente') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                            <a href='{{ url('') }}/vallas/borrarImagen/{{ $valla->id }}'
                                                class="btn btn-danger">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endif --}}
                    </div>

                    {{-- Botones de accion --}}
                    <div>
                        @if ($modo == 'show')
                            <a href='{{ url('') }}/vallas/show/{{ $valla->id }}'
                                class='btn btn-sm btn-dark mx-1' alt="Ver"><i class="fas fa-eye m-2"></i></a>

                            <a href="{{ url('') }}/vallas/edit/{{ $valla->id }}"
                                class='btn btn-sm btn-info mx-1' alt="Editar"><i
                                    class="fas fa-pencil-alt m-2"></i></a>


                            <button type="button" class="btn btn-sm btn-danger delete-button mx-1" data-toggle="modal"
                                data-target="#modalmessage" data-val="{{ $valla->id }}"><i
                                    class="fas fa-trash-alt m-2"></i>
                            </button>
                        @endif
                    </div>
                    
                @else
                    {{-- Parte de la derecha de la imagen valla --}}
                    <div class="col mx-3">

                        {{-- Parte superior de la carta --}}
                        <div class="row d-flex flex-row mb-4 justify-content-between">
                            <div class="d-flex flex-row">

                                @if ($modo == 'update')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        style="margin-top: 35px; margin-bottom:5px" data-toggle="modal"
                                        data-target="#modal-delete-{{ $valla->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    {{-- modal para eliminar --}}

                                    <div class="modal fade" id="modal-delete-{{ $valla->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" style="margin-top:15%;" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title"
                                                        id="modal-title-delete-{{ $valla->id }}">
                                                        {{ __('Eliminar imagen') }}
                                                    </h6>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="py-3 text-center">
                                                        <i class="fas fa-trash fa-3x"></i>
                                                        <h4 class="heading mt-4">{{ __('¿Estas seguro?') }}</h4>
                                                        <p>{{ __('¿Estas seguro de que quieres eliminar las imagenes? Habra que introducirlas posteriormente') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <a href='{{ url('') }}/vallas/borrarImagen/{{ $valla->id }}'
                                                        class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Botones de accion --}}
                            <div class="mb-2 rounded ">
                                @if ($modo == 'show')
                                    <a href='{{ url('') }}/vallas/show/{{ $valla->id }}'
                                        class='btn btn-sm rounded border shadow mx-1' alt="Ver" style="background-color: rgb(198,255,241);">
                                        <i class="fas fa-eye m-2 "></i></a>

                                    <a href="{{ url('') }}/vallas/edit/{{ $valla->id }}"
                                        class='btn btn-sm rounded border shadow mx-1' alt="Editar" style="background-color: rgb(57, 220, 231)"><i
                                            class="fas fa-pencil-alt m-2"></i></a>


                                    <button type="button" class="btn btn-sm rounded border shadow delete-button mx-1"
                                        style="background-color: rgba(255, 0, 43, 0.363)"
                                        data-toggle="modal" data-target="#modalmessage"
                                        data-val="{{ $valla->id }}"><i class="fas fa-trash-alt m-2"></i>
                                    </button>
                                @endif
                            </div>
            @endif

            {{-- Campo para subir el logo --}}
            @if ($modo == 'create' || $modo == 'update')
                <div class="d-flex row border rounded shadow p-4 mb-4">
                    <div class="col-12 text-center mb-2">
                        <h5 class="text-bold border border-light shadow w-25 m-auto rounded"
                            style="background-color:rgb(176, 253, 253)">FOTOGRAFIAS</h5>
                    </div>

                    <div class="col-6">
                        <label for="Norte">Norte: </label>
                        <input type="file" name="norte" value="" id="norteInput" accept="image/*"
                            class="form-control input-lg  border rounded shadow pt-1">


                    </div>
                    <div class="col-6">
                        <label for="Sur">Sur: </label>
                        <input type="file" name="sur" value="" id="surInput" accept="image/*"
                            class="form-control input-lg border rounded shadow pt-1">
                    </div>
                    <div class="col-6">
                        <label for="Este">Este: </label>
                        <input type="file" name="este" value="" id="esteInput" accept="image/*"
                            class="form-control input-lg border rounded shadow pt-1">
                    </div>

                    <div class="col-6">
                        <label for="Oeste">Oeste: </label>
                        <input type="file" name="oeste" value="" id="oesteInput" accept="image/*"
                            class="form-control input-lg border rounded shadow pt-1">
                    </div>
                </div>
            @endif




            <div class="d-flex row border rounded shadow p-4 mb-4 mt-3">
                
                <div class="col-12 text-center mb-2">
                    <h5 class="text-bold border border-light shadow w-25 m-auto rounded"
                        style="background-color:rgb(176, 253, 253)">DATOS VALLA</h5>
                </div>

          
                {{-- CAMPOS DE ALIAS Y DIRECCION (no se por que no esta en un div) --}}
                    <div class="col-6 d-flex flex-column w-100">
                        <label for="alias">Alias</label>
                        <input class="mb-3 border rounded shadow p-2" type="text" name="alias" id="alias"
                            placeholder="alias" value="{{ $modo == 'create' ? '' : $valla->alias }}" required
                            {{ $modo == 'update' || $modo == 'create' ? '' : 'readonly style=outline:none;' }}>
                    </div>

                    <div class="col-6 d-flex flex-column w-100">
                        <label for="localidad">Localidad</label>
                        <input class="mb-3 border rounded shadow p-2" type="text" name="localidad" id="localidad"
                            placeholder="localidad" value="{{ $modo == 'create' ? '' : $valla->localidad }}" required
                            {{ $modo == 'update' || $modo == 'create' ? '' : 'readonly style=outline:none;' }}>
                    </div>
               
                
                <div class="col-6 d-flex flex-column w-100">
                    <label for="direccion">Dirección</label>
                    <input class="mb-3 border rounded shadow p-2" type="text" name="direccion" id="direccion"
                        placeholder="direccion" value="{{ $modo == 'create' ? '' : $valla->direccion }}" required
                        {{ $modo == 'update' || $modo == 'create' ? '' : 'readonly style=outline:none;' }}>

                </div>

                <div class="col-6 d-flex flex-column w-100">
                    <label for="direccion">Tamaño</label>
                    <input class="mb-3 border rounded shadow p-2" type="text" name="tamano" id="tamano"
                        placeholder="tamano" value="{{ $modo == 'create' ? '' : $valla->tamano }}"
                        required {{ $modo == 'update' || $modo == 'create' ? '' : 'readonly style=outline:none;' }}>
                </div>
            




                {{-- FILA DONDE SE ENCUENTRA VER EN MAPS, POR AHORA VA A LA PAGINA DE GOOGLE MAPS Y PONE UN MARCADOR --}}

                {{-- CAMPOS PARA LATITUD Y LONGITUD --}}
                
                    @if ($modo == 'create' || $modo == 'update' || $modo == 'showonly')
                        
                        <div class=" col-6 d-flex flex-column w-100">
                            <label for="latitud" class="">Latitud</label>
                            <input class="w-100 border rounded shadow p-2" id="latitud" type="number" step="any"
                                name="latitud" placeholder="latitud"
                                value="{{ $modo == 'create' || $modo == 'create' ? '' : $valla->latitud }}" required
                                {{ $modo == 'update' || $modo == 'create' ? '' : 'readonly style=outline:none;' }}>
                        </div>

                        <div class=" col-6 d-flex flex-column w-100">

                            <label for="longitud" class="">Longitud</label>
                            <input class="w-100 border rounded shadow p-2" id="longitud" type="number" step="any"
                                name="longitud" placeholder="longitud"
                                value="{{ $modo == 'create' ? '' : $valla->longitud }}" required
                                {{ $modo == 'update' || $modo == 'create' ? '' : 'readonly style=outline:none;' }}>
                        </div>
                   

                    
                        {{-- Ponemos para que cuando estemos en modo create no aparezca el boton --}}

                        @if ($modo == 'create' || $modo == 'update')
                        <div class=" col-6 d-flex flex-column  mt-4">
                            <button type="button" id="geo" class="btn btn-secondary w-70 p-1 mt-2 float-left">
                                Geolocalización</button>
                        </div>
                        @endif

                        <div class="{{ $modo == 'create' ? 'd-none' : 'd-flex col-6 flex-column w-80 mt-4' }}">

                            <a target="_blank"
                                href="https://www.google.es/maps/search/?api=1&query={{ $modo == 'create' ? '' : $valla->latitud }},{{ $modo == 'create' ? '' : $valla->longitud }}"
                                class="btn btn-success w-100 p-1 mt-2 {{ $modo == 'create' || $modo == 'update' || $modo == 'create' ? '' : '' }}">VER
                                EN MAPS</a>

                        </div>
                        
                    
                    @endif


            </div>

            {{-- @else --}}

            {{-- ROW DE LABEL DE INCIDENCIAS Y TEXTAREA --}}
            @if ($modo == 'create' || $modo == 'update' || $modo == 'showonly')
                <div class="d-flex row border rounded shadow p-4">
                    <div class="col-12 text-center mb-2">
                        <h5 class="text-bold border border-light shadow w-25 m-auto rounded"
                            style="background-color:rgb(176, 253, 253)">OBSERVACIONES</h5>
                    </div>
                
            @endif

            @if ($modo == 'create' || $modo == 'update' || $modo == 'showonly')
                <div class=" w-100 mt-1 " style="height: 155px">

                    <textarea class="col-12 border rounded shadow" type="text" name="incidencias" style="height: 155px"
                        placeholder="{{ $modo == 'show' || $modo == 'showonly' ? 'No hay incidencias' : 'Escribir una incidencia...' }}"
                        style="resize: none;" class="w-100 h-100"
                        {{ $modo == 'show' || $modo == 'showonly' ? 'readonly' : '' }}>{{ $modo == 'create' ? '' : $valla->incidencias }}</textarea>

                </div>
            </div>
            @endif
            
        

    </div>

</div>

</div>



@if ($modo == 'show' )
    <label for="hola">Observaciones</label>
    <div class="row mt-1 " style="height: 80px">

        <textarea class="col border rounded shadow w-100" type="text" name="incidencias"
            placeholder="{{ $modo == 'show' || $modo == 'showonly' ? 'No hay incidencias' : 'Escribir una incidencia...' }}"
            style="resize: none;" class="w-100 h-100"
            {{ $modo == 'show' || $modo == 'showonly' ? 'readonly' : '' }}>{{ $modo == 'create' ? '' : $valla->incidencias }}</textarea>

    </div>
@endif




@if ($modo != 'show')
    <div class="border rounded shadow mt-2">

        {{-- BOTONES DE VOLVER Y GUARDAR (SOLO APARECE EN DETERMINADAS VISTAS) --}}


        <div class="col-12 ">
            <div class="card-footer ">
                <a href="{{ url('vallas') }}" class="btn btn-secondary float-left">Volver</a>
                @if ($modo != 'showonly')
                    <button type="button" name="" data-toggle="modal" data-target="#modalmessage"
                        class="btn btn-primary float-right">Guardar</button>
                @endif
            </div>
        </div>

    </div>
@endif


{{-- SI EL MODO EN EL QUE ESTAMOS ES DISTINTO DE VER UNA SOLA VALLA --}}

@if ($modo != 'showonly')
    <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    @if ($modo == 'create')
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de operación de
                            creación</h5>
                    @elseif($modo == 'update')
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de operación de
                            edición</h5>
                    @else
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de operación de
                            borrado</h5>
                    @endif

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($modo == 'create')
                    <div class="modal-body">
                        <p>¿Está seguro de que desea realizar la operación? </p>
                    </div>
                @elseif($modo == 'update')
                    <div class="modal-body">
                        <p>¿Está seguro de que desea realizar la operación? </p>
                    </div>
                @else
                    <div class="modal-body">
                        <p> ¿Está seguro de que desea eliminar los datos?</p>
                        <p>Esta operación no puede deshacerse </p>
                    </div>
                @endif

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    @if ($modo == 'create')
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    @elseif($modo == 'update')
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    @else
                        <a href="" class='btn btn-danger'>Eliminar</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endif
</div>
</form>
</div>


@if (session()->has('succ3'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: 'La valla ha sido borrada con exito',
            timer: 2000,
            showConfirmButton: false,
        })
    </script>
@endif
@if (session()->has('err3'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La valla no ha podido ser borrada',
            timer: 2000,
            showConfirmButton: false,
        })
    </script>
@endif

{{-- MODAL PARA ELIMINAR VALLA --}}


<script>
    $(document).ready(function() {

        $("#geo").click(function() {

            var options = {
                enableHighAccuracy: true,
                timeout: 6000,
                maximumAge: 0
            };

            navigator.geolocation.getCurrentPosition(success, error, options);

            function success(position) {
                var coordenadas = position.coords;

                console.log('Tu posición actual es:');
                console.log('Latitud : ' + coordenadas.latitude);
                $("#latitud").val(coordenadas.latitude);
                $("#longitud").val(coordenadas.longitude);
                console.log('Longitud: ' + coordenadas.longitude);
                console.log('Más o menos ' + coordenadas.accuracy + ' metros.');
            };

            function error(error) {
                console.warn('ERROR(' + error.code + '): ' + error.message);
            };



        });
        
        $(".delete-button").click(function() {
            var id = $(this).attr("data-val");
            $('#modalmessage').find("a").first().attr("href", "{{ url('') }}/vallas/delete/" +
                id);

        });
    });

     // PREVIEWS
    // preview norte foto
    norteInput.onchange = evt => {
        const [file] = norteInput.files
        if (file) {
            norte.src = URL.createObjectURL(file)
        }
    }
    // preview sur foto
    surInput.onchange = evt => {
        const [file] = surInput.files
        if (file) {
            sur.src = URL.createObjectURL(file)
        }
    }
    // preview este foto
    esteInput.onchange = evt => {
        const [file] = esteInput.files
        if (file) {
            este.src = URL.createObjectURL(file)
        }
    }
    // preview oeste foto
    oesteInput.onchange = evt => {
        const [file] = oesteInput.files
        if (file) {
            oeste.src = URL.createObjectURL(file)
        }
    }
</script>
