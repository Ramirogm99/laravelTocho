@php
date_default_timezone_set('Europe/Madrid');
$time = strtotime(now());
@endphp

{{-- Extiende de la plantilla --}}
@extends('adminlte::page')

{{-- Titulo de la ventana --}}
@section('title', 'Edición')

{{-- Cabecera de la pagina --}}
@section('content_header')
    <h1>Edición de Contrato : {{@$contrato->id}}</h1>
@stop



{{-- Contenido de la página --}}
@section('content')
    <div class="form-check">
        <form action="{{  url("contratos/update/$contrato->id") }}" class="my_form row"
            enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
            {{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> --}}
            <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="b2697287">
                        
                            
                        
                        <input type="hidden" name="contrato" value="{{$contrato->id}}">
                        <input type="hidden" name="f_inicio" id="f_inicio" value="{{$contrato->f_inicio}}">
                        <input type="hidden" name="f_fin" id="f_fin" value="{{$f_fin}}">
                        <input type="hidden" name="id_cliente" value="{{$cliente->id}}">
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

                                           
                                                <th data-field="Cliente">Alias</th>
                                                <th data-field="Inicio">Dirección</th>
                                                <th data-field="Inicio">Precio</th>
                                                <th data-field="Inicio">Material</th>
                                                <th data-field="Fin">Imagen</th>
                                                <th data-field="Acciones" id="acciones" class="max-width:100px">Eliminar del Contrato
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($vallas as $valla)
                                                {{-- Calculo del numero de dias restantes --}}

                                            

                                                
                                                <tr>
                                                 
                                                  
                                                    <td>{{ $valla->alias }} <input type="hidden" name="vallas[]" value="{{$valla->id}}"></td>
                                                    <td>{{ $valla->direccion  }}</td>
                                                    <td><input class="form-control" type="decimal" steps="any" name="precio[]" value="{{ $valla->precio }}" required><input class="form-control" type="decimal" steps="any" name="precio_produccion[]" value="{{ $valla->precio_produccion }}" required></td>
                                                    <td><select class="form-control select2" name="material[]" id="material{{$valla->id}}" required onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
                                                          @foreach($materiales as $material)
                                                            <option @if($material->tipo == $valla->material->tipo) selected @endif value="{{$material->id}}">{{$material->tipo}}</option>
                                                          @endforeach
                                                          
                                                    </select></td>
                                                    
                                                    <td> <img style="width:130px; height=80px;" src="{{url('')}}/public/storage/{{$valla->norte}}" > </td>

                                                    <td>
                                                        <div class="text-center">
                                                            <button  type="button" onclick="document.getElementById('flexCheckDefault{{$valla->id}}').checked?document.getElementById('flexCheckDefault{{$valla->id}}').checked=false:document.getElementById('flexCheckDefault{{$valla->id}}').checked=true;" class="btn btn-danger fas fa-trash-can"> 
                                                            </button>
                                                            <input class="form-check-input mx-auto" name="borrar[]"
                                                                type="checkbox" value="{{ $valla->id }}"
                                                                id="flexCheckDefault{{$valla->id}}" /><label class="form-check-label"
                                                                for="flexCheckDefault">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                                
                                                    

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <div class="card card-primary">
                                        <div class="card-footer mx-auto center">
                                    <button  type="button" id="addRow"  class="btn btn-warning "> Añadir Valla 
                                    </button>  
                                    
                                        </div>
                                    </div>
                                    <div class="card card-primary">
                                        <div class="card-footer mx-auto center">
                                            
                                            <button type="submit" class="btn btn-primary " id="maquetar" >Aceptar</button>
                                            
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



        let fechaInicioVal = $("#f_inicio").val();
            let fechaFinVal = $("#f_fin").val();
          
            const token = document.querySelector("#csrfToken");
                
                const vallasArray = async (fechaInicioVal, fechaFinVal) => {
                    const res = await fetch('../../vallas/ajaxRequest', {
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

                const matsArray = async () => {
                    const res = await fetch('../../materiales/ajaxRequest', {
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
                
               
                let vallas = vallasArray(fechaInicioVal, fechaFinVal);

                

        $(document).ready(function() {
  
            var table = $('#tablacontratos').DataTable({
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




           

                
                var counter = 1;
                var newRow = $('#addRow');
                
                $('#addRow').on( 'click', function () {
                    
                    table.row.add( [
                        `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;"><select onload='console.log($(this).select2());' onchange='setDireccion(${counter}); ' class="form-control select2 input-lg vallasSeleccionadas"  id="vallasSelector${counter}" required onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
                            <option value='-1'>Seleccionar valla (solo disponibles)</option></select><input type="hidden" id="hidden${counter}" name="vallas[]"></div>`,
                        `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;"><input type="text" class="form-control" id="direccion${counter}" name="DireccionVallasContrato[]" readonly required></div>`,
                        `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;"><input type="decimal" steps="any" class="form-control" id="precio${counter}" name="precio[]" required><input type="decimal" steps="any" class="form-control" id="precio_produccion${counter}" name="precio_produccion[]" required></div>`,
                   
                        `<div style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;">
                            <select class="form-control select2" name="material[]" id="material${counter}" required onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;"></select>
                            </div>`,
                            `<div style="text-align: center;  margin-bottom: 1rem;"><img src="{{ url('') }}/public/storage/saile1.jpg" id="imagen${counter}" class="img-thumbnail" width="400" height="350"></div>`,
                        `<div class="text-center">
                                                            <button  type="button" onclick="document.getElementById('newCheck${counter}').checked?document.getElementById('newCheck${counter}').checked=false:document.getElementById('newCheck${counter}').checked=true;" class="btn btn-danger fas fa-trash-can"> 
                                                            </button>
                                                            <input class="form-check-input mx-auto" name="borrar[]"
                                                                type="checkbox" value="valla${counter}"
                                                                id="newCheck${counter}" /><label class="form-check-label"
                                                                for="flexCheckDefault">
                                                        </div>`
                    ] ).draw();
                          
                    
                    var selcounter = counter;
                    vallas.then((res) => res.forEach((element, it) => {
                        
                        var o = new Option(element.alias, element.id);
                        
                        $(o).html(element.alias);
                     
                        $(`#vallasSelector${selcounter}`).append(o);

                    }))

                    mats.then((res) => res.forEach((element, it) => {
                           
                           var o2 = new Option(element.tipo, element.id);
                           
                           $(o2).html(element.tipo);
                        
                           $(`#material${selcounter}`).append(o2);
                          
                    }))

                    counter++;
                    
                    $('#addRow').prop("disabled",true);
                    

                } );
 


        })

        function setDireccion(index){
                    const direccionInput = document.querySelector('#direccion' + index);
                    const selector = document.querySelector('#vallasSelector' + index);
                    const hidden = document.querySelector('#hidden' + index);
                   
                    const img = document.querySelector('#imagen' + index);

                    

                    vallas.then((res) => res.forEach((element, it) => {
                        
                        if (element.id == selector.value) {
                        
                            
                            direccionInput.setAttribute('value', element.direccion);
                            selector.disabled = true;
                            $(`#newCheck${index}`).val(element.id);
                            hidden.setAttribute('value', element.id);
                            img.setAttribute('src', `{{ url('') }}/public/storage/${element.norte}`);
                      
                            res.splice(it, 1);
                          
                        }

                    }))

                    selector.disabled=true;
             
                    $('#addRow').prop("disabled", false);
                };


        let selectall = document.getElementById('selectAll');
        let checks = document.querySelectorAll("input[type=checkbox]");
        let maquetar = document.getElementById('maquetar')
    

        
        
    </script>
   
@stop
