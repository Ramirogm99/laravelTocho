{{-- FORMULARIO CONTRATO --}}
<p class="d-none">{{ date_default_timezone_set('Europe/Madrid') }}</p>

<section class="content">
    <div class="box">
        <input type="hidden" id="urlapp" value="http://localhost/alquiler/">
        <div class="box-body">
            {{-- AL RELLENAR EL FORMULARIO SE ENVIARA LA INFORMACION A CREARUSUARIO EN LA RUTA --}}
            {{-- Dependiendo del modo que se le pase, accede a una ruta u otra --}}
            @if ($modo == 'update')
                <form action='{{ url("contratos/update/$contrato->id") }}' class="my_form row"
                    enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
                @elseif($modo == 'create')
                    <form action="{{ url('contratos/insert') }}" class="my_form row" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8" autocomplete="off">
                    @else
                        <form action="" class="my_form row" enctype="multipart/form-data" method="post"
                            accept-charset="utf-8" autocomplete="off">
            @endif

            <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="b2697287">
            <div class="col-12">
                <div class="card card-primary card-outline">

                    {{-- CABECERA DEL FORMULARIO DE EDITAR --}}
                    <div class="card-header">
                        <h3 class="card-title">General</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>

                    {{-- CUERPO DEL FORMULARIO --}}
                    <div class="card-body">

                        @if ($modo == 'filtro')
                            @if (!isset($filtro))

                                <div class="row">


                                    <div class="form-group col-md-3">
                                        <label for="id">Contrato</label>
                                        <select name="id" id="id" class="form-control  select2 "
                                            {{ $modo != 'filtro' ? 'disabled' : '' }} tabindex="-1" aria-hidden="true"
                                            onmousedown="if(this.options.length>8){this.size=8;}"
                                            onchange='this.size=0;' onblur="this.size=0;">
                                            <option value="todos" selected>Seleccionar Contrato</option>
                                            @foreach ($contratos as $contrato)
                                                <option value="{{ $contrato->id }}">{{ $contrato->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                            @else
                            @endif
                        @endif
                        <div class="row">

                            {{-- FECHA INICIO --}}


                            <div class="form-group col-md-6">

                                <label for="f_inicio">Fecha de inicio*</label> <input type="date" name="f_inicio"
                                    id="f_inicio"
                                    @if ($modo != 'create' && $modo != 'filtro') value="{{ $contrato ? str_replace(' ', 'T', date('Y-m-d', strtotime("$contrato->f_inicio"))) : '' }}" @elseif($modo == 'filtro')value="{{ str_replace(' ', 'T', date('Y-m-d H:i')) }}" @endif
                                    @if ($modo != 'update' && $modo != 'filtro') min="{{ str_replace(' ', 'T', date('Y-m-d')) }}" @endif
                                    id="f_inicio" class="form-control input-lg"
                                    {{ $modo == 'show' ? 'readonly' : '' }} required>
                            </div>

                            {{-- FECHA FIN --}}
                            <div class="form-group col-md-6">
                                <label for="f_fin">Fecha de vencimiento*</label> <input type="date" name="f_fin"
                                    id="f_fin"
                                    @if ($modo != 'create' && $modo != 'filtro') value="{{ $contrato ? str_replace(' ', 'T', date('Y-m-d', strtotime("$contrato->f_fin"))) : '' }}"@elseif($modo == 'filtro')value="{{ str_replace(' ', 'T', date('Y-m-d H:i', strtotime('+1 day'))) }}" 
                                    min="{{ str_replace(' ', 'T', date('Y-m-d')) }}" @endif
                                    class="form-control input-lg" {{ $modo == 'show' ? 'readonly' : '' }} required>
                            </div>

                            {{-- CLIENTE --}}
                            @if ($modo == 'show')
                                <div class="form-group col-md-3">
                                    <label for="id_cliente">Cliente</label>
                                    <input type="text" class="form-control"
                                        value="{{ $cliente->d_social ? $cliente->d_social : $cliente->nombre }}"
                                        readonly>
                                </div>
                            @elseif ($modo == 'update')
                                <div class="form-group col-md-6">
                                    <label for="id_cliente">Cliente</label>
                                    <select name="id_cliente" id="id_cliente"
                                        class="form-control input-lg select2 select2-hidden-accessible">
                                        <option selected value="{{ $cliente->id }}">
                                            {{ $cliente->d_social ? $cliente->d_social : $cliente->nombre }}</option>
                                        @if (isset($clientes))
                                            @foreach ($clientes as $client)
                                                @if ($cliente->id != $client->id)
                                                    <option value="{{ $client->id }}">
                                                        {{ $client->d_social ? $client->d_social : $client->nombre }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @elseif ($modo == 'filtro')
                                @if (!isset($filtro))
                                    <div class="form-group col-md-3">
                                        <label for="id_cliente">Cliente</label>
                                        <select name="id_cliente" id="id_cliente" class="form-control select2">
                                            <option value="todos" selected>Seleccionar Cliente</option>
                                            @if (isset($clientes))
                                                @foreach ($clientes as $client)
                                                    <option value="{{ $client->id }}">
                                                        {{ $client->d_social ? $client->d_social : $client->nombre }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                @elseif($filtro == 'vallasNoDisponibles')
                                    <div class="form-group col-md-3">
                                        <label for="id_valla">Valla</label>
                                        <select name="id_valla" id="id_valla" class="form-control select2">
                                            <option value="todos" selected>Seleccionar Valla</option>
                                            @if (isset($vallas))
                                                @foreach ($vallas as $valla)
                                                    <option value="{{ $valla->id }}">
                                                        {{ $valla->alias ? $valla->alias : $valla->nombre }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                @else
                                @endif
                            @else
                                <div class="form-group col-md-3">
                                    <label for="id_cliente">Cliente</label>
                                    <select name="id_cliente" id="id_cliente"
                                        class="form-control input-lg select2 select2-hidden-accessible"
                                        data-select2-id="auth_level_user"
                                        {{ $modo != 'create' && $modo != 'filtro' ? 'disabled' : '' }} tabindex="-1"
                                        aria-hidden="true">
                                        @foreach ($clientes as $client)
                                            <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            @endif
                        </div>
                        @if ($errors)
                            <p class="text-center text-danger font-weight-bold">{{ $errors->first() }}</p>
                        @endif
                        <div class="row" id="tableDiv">
                            <div class="col">
                                @if (isset($filtro) ? $filtro == 'vallasNoDisponibles' : false)
                                @else
                                    <h4>Vallas</h4>
                                @endif
                                <div class="table-responsive">
                                    <table id="tablacontratos" style="width:100%; border: 0;"
                                        class="table table-hover table-striped table-bordered table-sm display">
                                        <thead class="thead-tabla">
                                            <tr>
                                                @if (isset($filtro) ? $filtro == 'vallasNoDisponibles' : false)
                                                    <th data-field="Inicio">Contrato</th>
                                                    <th data-field="Fin">Cliente</th>
                                                    <th data-field="Fin">Acciones</th>
                                                @else
                                                    <th data-field="Inicio">Nombre</th>
                                                    <th data-field="Fin">Dirección</th>
                                                    <th data-field="Fin">Precio</th>
                                                    <th data-field="Fin">Material</th>
                                                    <th data-field="Fin">Valla</th>
                                                    <th data-field="Fin">Acciones</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($modo == 'show')
                                                <?php $index = 0; ?>
                                                @foreach ($vallas as $valla)
                                                    <tr>
                                                        <td>{{ $valla->alias }}</td>
                                                        <td>{{ $valla->direccion }}</td>
                                                        <td>Alquiler: <span style="float:right"
                                                                class="mr-2">{{ $valla->precio }} €</span>
                                                            <br>Producción : <span style="float:right"
                                                                class="mr-2">{{ is_null($valla->precio_material) ? 'No' : "$valla->precio_material €" }}
                                                            </span> </td>
                                                        <td>{{ $valla->material->tipo }}</td>


                                                        <td><img id="pic{{ $index }}"
                                                                src="@if (isset($valla->norte) && $valla->norte != '') {{ url('') }}/public/storage/{{ @$valla->alias }}/{{ @$valla->norte }}
                                                            @else {{ url('') }}/public/storage/saile1.jpg" @endif"
                                                                data-toggle="modal"
                                                                data-target="#modalFoto{{ $index }}"
                                                                style="object-fit: contain; cursor: pointer;  max-width:200px; max-height: 140px; margin: 0 auto;" />
                                                        </td>


                                                        <td>
                                                            <a href="{{ url("vallas/show/$valla->id") }}"
                                                                class='btn btn-sm btn-dark'><i
                                                                    class="fas fa-eye"></i></a>

                                                            <a href="{{ url("vallas/edit/$valla->id") }}"
                                                                class='btn btn-sm btn-info'><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                        </td>
                                                    </tr>

                                                    <?php $index++; ?>
                                                @endforeach
                                            @elseif ($modo == 'update')
                                                <?php $index = 0; ?>
                                                @foreach ($vallas as $valla)
                                                    <tr>
                                                        <td>{{ $valla->alias }}</td>
                                                        <td>{{ $valla->direccion }}</td>
                                                        <td>
                                                            <img id="pic{{ ++$index }}"
                                                                src="@if (isset($valla->norte) && $valla->norte != '') {{ url('') }}/public/storage/{{ @$valla->alias }}/{{ @$valla->norte }}
                                                                @else {{ url('') }}/public/storage/saile1.jpg" @endif"
                                                                data-toggle="modal"
                                                                data-target="#modalFoto{{ $index }}"
                                                                style="object-fit: contain; cursor: pointer;  max-width:200px; max-height: 140px; margin: 0 auto;" />
                                                        </td>
                                </div>
                            </div>

                            </td>

                            <td>
                                <a href="{{ url("vallas/show/$valla->id") }}" class='btn btn-sm btn-dark'><i
                                        class="fas fa-eye"></i></a>

                                <a href="{{ url("vallas/edit/$valla->id") }}" class='btn btn-sm btn-primary'><i
                                        class="fas fa-pencil-alt"></i></a>
                            </td>
                            </tr>
                            @endforeach
                        @elseif ($modo == 'show')
                            @endif

                            </tbody>
                            </table>

                            <?php $i = 0; ?>

                            @foreach ($vallas as $valla)
                                <div class="modal fade" id="modalFoto{{ $i }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Foto</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">


                                                <img id="fotoModal"
                                                    src="@if (isset($valla->norte) && $valla->norte != '') {{ url('') }}/public/storage/{{ @$valla->alias }}/{{ @$valla->norte }}
                                            @else {{ url('') }}/public/storage/saile1.jpg" @endif"
                                                    style="object-fit: contain;  max-width:470px; max-height: 440px; margin: 0 auto;" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php $i++; ?>
                            @endforeach

                            {{-- Modal para mostrar la foto --}}



                            @if ($modo == 'create')
                                <button type="button" class="btn btn-primary m-2" id="addValla">
                                    <i class="fa-solid fa-plus"></i> Añadir valla al contrato
                                </button>


                                {{-- Script que maneja la tabla de las vallas --}}

                                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
                                    rel="stylesheet" />
                                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                                <script>
                                    $(".select2").select2({
                                        width: '300px',
                                        height: 'resolve',
                                    });
                                    $(".select2-container--default .select2-selection--single .select2-selection__rendered").css("margin-top", "-8px");

                                    const fInicio = document.querySelector('#f_inicio');
                                    const fFin = document.querySelector('#f_fin');
                                    const token = document.querySelector("#csrfToken");
                                    document.querySelector('#tableDiv').style.display = 'none';

                                    let fechaInicioVal = fInicio.value;
                                    let fechaFinVal = fFin.value;

                                    // Variable con los datos de todas las vallas de la tabla vallas
                                    let vallas;
                                    let vallasBorradas = [];

                                    // Variables auxiliares
                                    let index = 0;
                                    let index2 = 0;
                                    let maxNumRows;
                                    let selectores = [];
                                    let direcciones = [];
                                    let materiales = [];
                                    let precios = [];
                                    let borrados = [];
                                    let ocultos = [];
                                    const matsArray = async () => {
                                        const res = await fetch('../materiales/ajaxRequest', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': token.value,
                                                'Accept': 'application/json',
                                                'Content-Type': 'application/json'
                                            },

                                        });
                                        const array = await res.json();
                                        return array;
                                    }
                                    let mats = matsArray();



                                    // Función para comprobar si las fechas están seteadas
                                    function checkDates(fechaInicioVal, fechaFinVal) {
                                        if (fechaInicioVal && fechaFinVal) {
                                            document.querySelector('#tableDiv').style.display = 'block';
                                            vallas = vallasArray(fechaInicioVal, fechaFinVal);
                                            if (fechaInicioVal > fechaFinVal) {
                                                fechaFinVal = fechaInicioVal;
                                            }
                                            return true;
                                        }
                                        return false;
                                    }

                                    // Función que limita la cantidad de vallas permitidas para alquilar al total
                                    // de vallas recogidas desde la db
                                    function maxNumRowsPermitted(index, maxNumRows) {
                                        if (index === maxNumRows) {
                                            addValla.style.display = 'none';
                                        }
                                    }

                                    function sortValla(valla1, valla2) {
                                        if (valla1.id > valla2.id) {
                                            return 1;
                                        }
                                        if (valla1.id < valla2.id) {
                                            return -1;
                                        }
                                        // a must be equal to b
                                        return 0;

                                    }
                                    // Función para borrar una row de la tabla
                                    function delRow(id) {
                                        const element = document.querySelector("#" + id.getAttribute('id'));

                                        idValla = element.querySelector('select').value;
                                        vallaFound = vallasBorradas.find(valla => valla.id == idValla);


                                        //Controles de las filas de selectores al borrar uno
                                        selectores.splice(vallasBorradas.indexOf(vallaFound), 1);
                                        selectores.forEach((element, it) => {

                                            element.id = `vallasSelector${it+1}`;
                                            element.onchange = `setDireccion(${it+1});`;

                                        });
                                        direcciones.splice(vallasBorradas.indexOf(vallaFound), 1);
                                        direcciones.forEach((element, it) => {

                                            element.id = `direccion${it+1}`;

                                        });
                                        precios.splice(vallasBorradas.indexOf(vallaFound), 1);
                                        precios.forEach((element, it) => {

                                            element.id = `precio${it+1}`;

                                        });
                                        materiales.splice(vallasBorradas.indexOf(vallaFound), 1);
                                        materiales.forEach((element, it) => {

                                            element.id = `material${it+1}`;

                                        });
                                        borrados.splice(vallasBorradas.indexOf(vallaFound), 1);
                                        borrados.forEach((element, it) => {

                                            element.id = `borrado${it+1}`;
                                            element.onchange = `delRow(row${it+1});`;
                                        });

                                        ocultos.splice(vallasBorradas.indexOf(vallaFound), 1);
                                        ocultos.forEach((element, it) => {

                                            element.id = `borrado${it+1}`;
                                            element.onchange = `delRow(row${it+1});`;
                                        });




                                        vallasBorradas.splice(vallasBorradas.indexOf(vallaFound), 1);

                                        vallas.then((res) => {
                                            res.push(vallaFound);
                                            res.sort(sortValla);

                                        });



                                        index--;


                                        element.outerHTML = '';


                                        maxNumRowsPermitted(--index2, maxNumRows);
                                        if (index < maxNumRows) {
                                            addValla.removeAttribute('style');
                                        }



                                    }

                                    // Traemos todos los datos de las vallas para el selector
                                    const vallasArray = async (fechaInicioVal, fechaFinVal) => {
                                        const res = await fetch('../vallas/ajaxRequest', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': token.value,
                                                'Accept': 'application/json',
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                f_inicio: fechaInicioVal,
                                                f_fin: fechaFinVal,
                                                tipo: 'nuevo_contrato'
                                            })
                                        });
                                        const array = await res.json();
                                        return array;
                                    }

                                    // Función para poner la dirección
                                    // Además habilita la función de crear contrato
                                    function setDireccion(index) {
                                        const direccionInput = document.querySelector('#direccion' + index);
                                        const selector = document.querySelector('#vallasSelector' + index);
                                        const hidden = document.querySelector('#hiddenSelector' + index);
                                        vallas.then((res) => res.forEach((element, it) => {
                                            if (element.id == selector.value) {
                                                direccionInput.setAttribute('value', element.direccion);
                                                selector.disabled = true;
                                                hidden.setAttribute('value', element.id);

                                                vallasBorradas.push(element);
                                                res.splice(it, 1);

                                            }

                                        }))


                                        if (index < maxNumRows) {
                                            addValla.removeAttribute('style');
                                        }
                                        document.querySelector('#submit').disabled = false;
                                        borrados.forEach(element => {

                                            element.disabled = false;
                                            console.log(element);
                                        });

                                    };

                                    window.onload = () => {
                                        const addValla = document.querySelector('#addValla');
                                        const table = document.querySelector('#tablacontratos>tbody');
                                        let selector;


                                        // Listener de fechas para setear el valor y posteriormente añadir vallas
                                        fInicio.onchange = (e) => {
                                            fechaInicioVal = e.target.value;
                                            fFin.setAttribute('min', e.target.value);
                                            checkDates(fechaInicioVal, fechaFinVal);
                                        }
                                        // Listener de fechas para setear el valor y posteriormente añadir vallas
                                        fFin.onchange = (e) => {
                                            fechaFinVal = e.target.value;
                                            checkDates(fechaInicioVal, fechaFinVal);
                                        }

                                        // Cuando se hace click en el botón de añadir valla se ejecuta esto
                                        addValla.addEventListener('click', (e) => {
                                            ++index2;
                                            ++index;
                                            // Insertamos una fila al hacer click
                                            const row = table.insertRow();
                                            // Le asignamos una id a la fila
                                            row.setAttribute('id', "row" + (index));
                                            // Insertamos 3 celdas, la primera con el selector, la segunda con la direccion
                                            // y la tercera con el botón de borrar
                                            row.insertCell(0).innerHTML =
                                                `<input type="hidden" name=AliasVallasContrato[] id="hiddenSelector${index}">
                                                        <select onchange='setDireccion(${index}); ' class="form-control select2 vallasSeleccionadas" name="AliasVallasContrato1[]" id="vallasSelector${index}" required onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;"></select>`
                                            selector = document.querySelector('#vallasSelector' + index);
                                            selector.innerHTML = `<option value='-1'>Seleccionar valla (solo disponibles)</option>`
                                            // Asignamos todas las vallas al selector
                                            vallas.then((res) => res.map((valla) => {
                                                selector.innerHTML +=
                                                    `<option class='valla' value='${valla.id}'>${valla.alias}</option>`
                                                // Se ejecuta de forma asíncrona; tarda más
                                                maxNumRows = res.length + vallasBorradas.length;
                                                maxNumRowsPermitted(index2, maxNumRows);
                                            }))

                                            row.insertCell(1).innerHTML =
                                                `<input type="text" class="form-control" id="direccion${index}" name="DireccionVallasContrato[]" readonly required>`;
                                            row.insertCell(2).innerHTML =
                                                `<input type="text" class="form-control" id="precio${index}" name="PrecioVallasContrato[]" required>`;
                                            row.insertCell(3).innerHTML =
                                                `<select class="form-control select2" name="MaterialVallasContrato[]" id="material${index}" required onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;"></select>`;
                                            material = document.querySelector('#material' + index);
                                            material.innerHTML = `<option value='-1'>Seleccionar material (solo disponibles)</option>`;

                                            mats.then((res) => res.map((mat) => {

                                                material.innerHTML +=
                                                    `<option class='material' value='${mat.id}'>${mat.tipo}</option>`
                                                // Se ejecuta de forma asíncrona; tarda más

                                            }))
                                            row.insertCell(4).innerHTML =
                                                `<input type="hidden" class="form-control" id="direccion${index}" name="DireccionVallasContrato[]" readonly required>`;

                                            row.insertCell(5).innerHTML = `<button id="borrado${index}" type="button" class="btn btn-sm btn-danger m-2"

                                                        onclick="delRow(row${index})"
                                                        >
                                                        <i class="fas fa-trash-alt m-2"></i>
                                                        </button>`;

                                            //desabilitamos el guardar hasta que se seleccione la valla
                                            document.querySelector('#submit').setAttribute('disabled', 'true');



                                            // Añadir los elementos creados a arrays para su control
                                            selectores.push(document.querySelector(`#vallasSelector${index}`));
                                            direcciones.push(document.querySelector(`#direccion${index}`));
                                            precios.push(document.querySelector(`#precio${index}`));
                                            materiales.push(document.querySelector(`#material${index}`));
                                            borrados.push(document.querySelector(`#borrado${index}`));
                                            ocultos.push(document.querySelector(`#hiddenSelector${index}`));

                                            e.target.style.display = "none";


                                            borrados.forEach(element => {
                                                element.setAttribute('disabled', 'true');
                                            });


                                        })
                                    }
                                </script>
                            @elseif($modo == 'filtro')
                                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
                                    rel="stylesheet" />
                                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                                <script>
                                    $(".select2").select2({
                                        width: 'resolve',
                                        height: 'resolve',
                                    });
                                    $(".select2-container--default .select2-selection--single .select2-selection__rendered").css("margin-top", "-8px");



                                    const fInicio = document.querySelector('#f_inicio');
                                    const fFin = document.querySelector('#f_fin');
                                    const token = document.querySelector("#csrfToken");


                                    const idValla = document.querySelector("#id_valla") ? document.querySelector("#id_valla") : '';

                                    let id_Valla = idValla.value ? idValla.value : '';



                                    document.querySelector('#tableDiv').style.display = 'none';

                                    let fechaInicioVal = fInicio.value;
                                    let fechaFinVal = fFin.value;

                                    // Variable con los datos de todas las vallas de la tabla vallas
                                    let vallas;
                                    //variable para mirar que vallas se quieren
                                    let checked = [];
                                    // Variables auxiliares
                                    let index = 0;
                                    let index2 = 0;
                                    let maxNumRows;

                                    // Función para comprobar si las fechas están seteadas
                                    function checkDates(fechaInicioVal, fechaFinVal) {
                                        if (fechaInicioVal && fechaFinVal) {

                                            vallas = vallasArray(fechaInicioVal, fechaFinVal);
                                            if (fechaInicioVal > fechaFinVal) {
                                                fechaFinVal = fechaInicioVal;
                                            }
                                            return true;
                                        }
                                        return false;
                                    }





                                    // Traemos todos los datos de las vallas para el selector

                                    const vallasArray = async (fechaInicioVal, fechaFinVal) => {
                                        fechaInicioVal = fechaInicioVal.replace("T", " ");

                                        fechaFinVal = fechaFinVal.replace("T", " ");
                                        if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasDisponibles') {
                                            const res = await fetch('../vallas/ajaxRequest', {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': token.value,
                                                    'Accept': 'application/json',
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({
                                                    f_inicio: fechaInicioVal,
                                                    f_fin: fechaFinVal,
                                                    tipo: 'vallas_disponibles',
                                                }),
                                                // success: jQuery('.select2-container').remove();

                                                // jQuery('.selector').select2({
                                                //     placeholder: "Placeholder text",
                                                //     allowClear: true
                                                // });

                                                // jQuery('.select2-container').css('width', '100%');
                                            });
                                            const array = await res.json();
                                            return array;
                                        } else if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasNoDisponibles') {
                                            const res = await fetch('../vallas/ajaxRequest', {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': token.value,
                                                    'Accept': 'application/json',
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({
                                                    id_valla: id_Valla,
                                                    f_inicio: fechaInicioVal,
                                                    f_fin: fechaFinVal,
                                                    tipo: 'vallas_no_disponibles',
                                                })
                                            });
                                            const array = await res.json();
                                            return array;
                                        }


                                        fechaFinVal = fechaFinVal.replace("T", " ");
                                        if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasDisponibles') {
                                            const res = await fetch('../vallas/ajaxRequest', {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': token.value,
                                                    'Accept': 'application/json',
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({
                                                    f_inicio: fechaInicioVal,
                                                    f_fin: fechaFinVal,
                                                    tipo: 'vallas_disponibles',
                                                })
                                            });
                                            const array = await res.json();
                                            return array;
                                        } else if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasNoDisponibles') {
                                            const res = await fetch('../vallas/ajaxRequest', {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': token.value,
                                                    'Accept': 'application/json',
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({
                                                    id_valla: id_Valla,
                                                    f_inicio: fechaInicioVal,
                                                    f_fin: fechaFinVal,
                                                    tipo: 'vallas_no_disponibles',
                                                })
                                            });
                                            const array = await res.json();
                                            return array;
                                        }

                                    }


                                    // Función para poner la dirección


                                    window.onload = () => {

                                        if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasDisponibles') {
                                            vallas = vallasArray(fechaInicioVal, fechaFinVal);
                                        } else if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasNoDisponibles') {
                                            vallas = vallasArray(fechaInicioVal, fechaFinVal, id_Valla);

                                        }

                                        const addValla = document.querySelector('#addValla');
                                        const table = document.querySelector('#tablacontratos>tbody');
                                        let selector;



                                        // Listener de fechas para añadir vallas
                                        if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasDisponibles') {
                                            document.querySelector("#filtrar").addEventListener('click', function() {
                                                document.querySelector('#tableDiv').style.display = 'block';


                                                vallas.then((res) => res.forEach((element, i) => {
                                                    const row = table.insertRow();


                                                    //Editar la valla disponible
                                                    row.setAttribute('id', "row" + (++i));
                                                    row.insertCell(0).innerHTML = `<td> ${element.alias} </td>`;
                                                    row.insertCell(1).innerHTML = `<td> ${element.direccion} </td>`;





                                                    row.insertCell(2).innerHTML =
                                                        `<td>
                                                                    <img id="pic${i}"
                                                                        src="{{ url('') }}/public/storage/${element.norte}"
                                                                        data-toggle="modal" data-target="#modalFoto${i}"
                                                                        style="object-fit: contain; cursor: pointer;  max-width:200px; max-height: 140px; margin: 0 auto;" /> </td>
                                                                        <div class="modal fade" id="modalFoto${i}" tabindex="-1"
                                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                                    >
                                                                    <div id="modalFoto${i}" class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Foto</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                
                                                                                    style="object-fit: contain;  max-width:470px; max-height: 440px; margin: 0 auto;" />
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-dismiss="modal">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>`;


                                                    row.insertCell(3).innerHTML = `<a href="{{ url('') }}/vallas/show/${element.id}"
                                                                    class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>
                                                            
                                                                <a href={{ url('') }}/vallas/edit/${element.id}"
                                                                    class='btn btn-sm btn-info'><i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                            `;


                                                    // let fotos = document.querySelectorAll('[id^=pic]');

                                                    // let modalfoto = document.querySelectorAll('#fotoModal');
                                                    // fotos.forEach((foto, i) => {
                                                    //     let srcimagen = foto.getAttribute('src');
                                                    //     modalfoto[i].setAttribute('src', srcimagen);
                                                    // });
                                                }))

                                                document.querySelector('#filtrar').disabled = true;

                                            });
                                        } else if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasNoDisponibles') {

                                            document.querySelector("#filtrar").addEventListener('click', function() {

                                                document.querySelector('#tableDiv').style.display = 'block';


                                                vallas.then((res) => res.forEach(element => {
                                                    //Editar las vallas no disponibles
                                                    const row = table.insertRow();

                                                    row.setAttribute('id', "row" + (element.index));
                                                    row.insertCell(0).innerHTML = `<td> ${element.id} </td>`;
                                                    row.insertCell(1).innerHTML = `<td> ${element.nombre} </td>`;
                                                    row.insertCell(2).innerHTML = `<a href="{{ url('') }}/contratos/show/${element.id}"
                                                                    class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>
                
                                                                <a href={{ url('') }}/contratos/edit/${element.id}"
                                                                    class='btn btn-sm btn-primary'><i class="fas fa-pencil-alt"></i></a>   
                                                            `;
                                                }))
                                                document.querySelector('#filtrar').disabled = true;

                                            });
                                        }

                                        if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasDisponibles') {
                                            // Listener de fechas para setear el valor y posteriormente añadir vallas
                                            fInicio.onchange = (e) => {
                                                fechaInicioVal = e.target.value.replace("T", " ");

                                                fFin.setAttribute('min', e.target.value);
                                                vallas = vallasArray(fechaInicioVal, fechaFinVal);
                                                checkDates(fechaInicioVal, fechaFinVal);

                                            }
                                            // Listener de fechas para setear el valor y posteriormente añadir vallas
                                            fFin.onchange = (e) => {
                                                fechaFinVal = e.target.value.replace("T", " ");
                                                vallas = vallasArray(fechaInicioVal, fechaFinVal);
                                                checkDates(fechaInicioVal, fechaFinVal);
                                            }
                                        } else if ('{{ isset($filtro) ? $filtro : 'no' }}' == 'vallasNoDisponibles') {
                                            fInicio.onchange = (e) => {
                                                fechaInicioVal = e.target.value;
                                                fFin.setAttribute('min', e.target.value);
                                                vallas = vallasArray(fechaInicioVal, fechaFinVal, id_Valla);
                                                checkDates(fechaInicioVal, fechaFinVal);

                                            }
                                            // Listener de fechas para setear el valor y posteriormente añadir vallas
                                            fFin.onchange = (e) => {
                                                fechaFinVal = e.target.value;
                                                vallas = vallasArray(fechaInicioVal, fechaFinVal, id_Valla);
                                                checkDates(fechaInicioVal, fechaFinVal);
                                            }
                                            idValla.onchange = (e) => {
                                                id_Valla = e.target.value;
                                                vallas = vallasArray(fechaInicioVal, fechaFinVal, id_Valla);
                                                checkDates(fechaInicioVal, fechaFinVal);
                                            }
                                        }



                                    }
                                </script>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- FOOTER DEL FORMULARIO --}}
            <div class="col-12">
                <div class="card-footer">
                    <a href="{{ url('contratos') }}@if ($modo == 'show') @if ($contrato->baja)/bajas @endif @endif"
                        class="btn btn-secondary float-left">Volver</a>
                    @if ($modo != 'show')
                        @if ($modo == 'filtro')
                            @if (isset($filtro) ? $filtro == 'vallasDisponibles' : false)
                                <div class="row justify-content">
                                    <div class="col-10">
                                        <a href='{{ url('mail') }}' type="button" id="correo" name="mysubmit"
                                            value="Correo" class="btn btn-primary float-right">
                                            Maquetar correo
                                        </a>
                                    </div>
                            @endif
                            <div class="col">
                                <button type="button" id="filtrar" name="mysubmit" value="Filtrar"
                                    class="btn btn-primary float-right">
                                    Filtrar
                                </button>
                            </div>

                </div>
            @else
                <button id='submit' type="button" name="mysubmit"
                    onclick="document.querySelector('.vallasSeleccionadas').disabled=false;" value="Guardar"
                    data-toggle="modal" data-target="#modalmessage" class="btn btn-primary float-right">
                    Guardar
                </button>
                @endif
                @endif
            </div>
        </div>

    </div>
    </div>

    {{-- --------------------------------------------------------------------------------------------------------------------------- --}}
    {{-- --------------------------------------------------------------------------------------------------------------------------- --}}

    {{-- MODAL INSERCCION / ACTUALIZACION --}}

    <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de
                        inserción/actualización</h5>
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
