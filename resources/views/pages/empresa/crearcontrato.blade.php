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
    <h1>Crear Contrato</h1>
@stop



{{-- Contenido de la página --}}
@section('content')

    {{-- FORMULARIO CONTRATO --}}
    <p class="d-none">{{ date_default_timezone_set('Europe/Madrid') }}</p>

    <section class="content">
        <div class="box">
            <input type="hidden" id="urlapp" value="http://localhost/alquiler/">
            <div class="box-body">
                <form action="{{ url('contratos/insert') }}" class="my_form row" enctype="multipart/form-data"
                    method="post" accept-charset="utf-8" autocomplete="off">
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
                                <div class="row">
                                    <div class="form-group col-md-6">

                                        <label for="f_inicio">Fecha de inicio*</label> <input type="date"
                                            name="f_inicio" id="f_inicio"
                                            min="{{ str_replace(' ', 'T', date('Y-m-d')) }}" id="f_inicio"
                                            class="form-control input-lg" required>
                                    </div>

                                    {{-- FECHA FIN --}}
                                    <div class="form-group col-md-6">
                                        <label for="f_fin">Fecha de vencimiento*</label> <input type="date"
                                            name="f_fin" id="f_fin" class="form-control input-lg" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="id_cliente">Cliente</label>
                                    <select name="id_cliente" id="id_cliente"
                                        class="form-control input-lg select2 select2-hidden-accessible"
                                        data-select2-id="auth_level_user" tabindex="-1" aria-hidden="true">
                                        @foreach ($clientes as $client)
                                            <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors)
                                    <p class="text-center text-danger font-weight-bold">{{ $errors->first() }}</p>
                                @endif

                                <div class="row" id="tableDiv">
                                    <div class="col">
                                        <h4>Vallas</h4>
                                        <div class="table-responsive">
                                            <table id="tablacontratos" style="width:100%; border: 0;"
                                                class="table table-hover table-striped table-bordered table-sm display">
                                                <thead class="thead-tabla">
                                                    <tr>
                                                        <th data-field="Inicio" class="text-center">Nombre</th>
                                                        <th data-field="Fin" class="text-center">Dirección</th>
                                                        <th data-field="Fin" class="text-center">Precio</th>
                                                        <th data-field="Fin" class="text-center">Material</th>
                                                        <th data-field="Fin" class="text-center">Valla</th>
                                                        <th data-field="Fin" class="text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Foto</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img id="fotoModal" src=""
                                                                style="object-fit: contain;  max-width:470px; max-height: 440px; margin: 0 auto;" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary m-2" id="addValla">
                                                <i class="fa-solid fa-plus"></i> Añadir valla al contrato
                                            </button>


                                            {{-- Script que maneja la tabla de las vallas --}}

                                            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                            <link
                                                href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
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
                                                let precios_material = [];
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

                                                function filtroRow() {
                                                    $('.selectextra').select2();
                                                    $(".select2-container--default .select2-selection--single .select2-selection__rendered").css("margin-top",
                                                        "-8px");
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
                                                    precios.forEach((element, it) => {

                                                        element.id = `precio_material${it+1}`;

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
                                                    console.log(array);
                                                    return array;
                                                }

                                                // Función para poner la dirección
                                                // Además habilita la función de crear contrato
                                                function setDireccion(index) {
                                                    const direccionInput = document.querySelector('#direccion' + index);
                                                    const selector = document.querySelector('#vallasSelector' + index);
                                                    const hidden = document.querySelector('#hiddenSelector' + index);
                                                    const img = document.querySelector('#imagen' + index);
                                                    vallas.then((res) => res.forEach((element, it) => {
                                                        if (element.id == selector.value) {
                                                            direccionInput.setAttribute('value', element.direccion);
                                                            selector.disabled = true;
                                                            hidden.setAttribute('value', element.id);
                                                            element.norte ? 
                                                                img.setAttribute('src', `{{ url('') }}/public/storage/${element.alias}/${element.norte}`) : 
                                                                img.setAttribute('src', `{{ url('') }}/public/storage/saile1.jpg`);
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
                                                            `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;"><input type="hidden" name=AliasVallasContrato[] id="hiddenSelector${index}">
                                                                    <select onload='console.log($(this).select2());' onchange='setDireccion(${index}); ' class="form-control selectextra input-lg vallasSeleccionadas" name="AliasVallasContrato1[]" id="vallasSelector${index}" required onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;"></select></div>`;
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
                                                        
                                                            `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;"><input type="text" class="form-control" id="direccion${index}" name="DireccionVallasContrato[]" readonly required></div>`;
                                                        row.insertCell(2).innerHTML =
                                                            `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;"><label for="precio${index}">Alquiler</label><input type="decimal" steps="any" class="form-control" id="precio${index}" name="PrecioVallasContrato[]" required> 
                                                                <label for="precio_material${index}">Producción</label><input type="decimal" steps="any" class="form-control" id="precio_material${index}" name="PrecioMaterialVallasContrato[]"></div>`;
                                                        row.insertCell(3).innerHTML =
                                                            `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;">
                                                                <select class="form-control selectextra" name="MaterialVallasContrato[]" id="material${index}" required onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;"></select>
                                                                </div>`;
                                                        material = document.querySelector('#material' + index);
                                                        material.innerHTML = `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;"><option selected disabled>Seleccionar material (solo disponibles)</option></div>`

                                                        mats.then((res) => res.map((mat) => {

                                                            material.innerHTML +=
                                                                `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;"><option class='material' value='${mat.id}'>${mat.tipo}</option></div>`
                                                            // Se ejecuta de forma asíncrona; tarda más

                                                        }))

                                                        //preview imagen valla seleccionada
                                                        row.insertCell(4).innerHTML =
                                                            `<div style="text-align: center;  margin-bottom: 1rem;"><img src="{{ url('') }}/public/storage/saile1.jpg" onclick="document.getElementById('fotoModal').src=this.src;" id="imagen${index}" class="img-thumbnail" width="400" height="350" data-toggle="modal" data-target="#modalFoto" ></div>`;




                                                        row.insertCell(5).innerHTML = `<div <div style="text-align: center; margin-top: 22px; margin-bottom: 1rem;display: flex;">

                                                                    <button id="filtro${index}" type="button" class="btn btn-sm btn-secondary mx-1"
                                                                    onclick="filtroRow();"

                                                                    >
                                                                    <i class="fa-solid fa-magnifying-glass "></i>
                                                                    </button>

                                                                    <button id="borrado${index}" type="button" class="btn btn-sm btn-danger mx-1"
                                                                    onclick="delRow(row${index})"
                                                                    >
                                                                    <i class="fas fa-trash-alt mx-2"></i>
                                                                    </button>

                                                                    </div>`;

                                                        //desabilitamos el guardar hasta que se seleccione la valla
                                                        document.querySelector('#submit').setAttribute('disabled', 'true');



                                                        // Añadir los elementos creados a arrays para su control
                                                        selectores.push(document.querySelector(`#vallasSelector${index}`));
                                                        direcciones.push(document.querySelector(`#direccion${index}`));
                                                        precios.push(document.querySelector(`#precio${index}`));
                                                        precios_material.push(document.querySelector(`#precio_material${index}`));
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
                                        </div>

                                    </div>
                                </div>

                            </div>
                            {{-- FOOTER DEL FORMULARIO --}}
                            <div class="col-12">
                                <div class="card-footer">
                                    <a href="{{ url('contratos') }}" class="btn btn-secondary float-left">Volver</a>
                                    <button id='submit' type="button" name="mysubmit"
                                        onclick="document.querySelector('.vallasSeleccionadas').disabled=false;"
                                        value="Guardar" data-toggle="modal" data-target="#modalmessage"
                                        class="btn btn-primary float-right">
                                        Guardar
                                    </button>
                                </div>
                            </div>

                        </div>


                        <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de
                                            inserción/actualización</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Está seguro de que desea realizar la operación? </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>

@stop
