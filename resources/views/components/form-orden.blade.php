<section class="content">
    <div class="box">
        <div class="box-header">

        </div>
        <input type="hidden" id="urlapp" value="http://loscalhost/alquiler/">

        <div class="box-body">

            @if ($modo == 'update')
                <form action='{{ url("ordenes/update/$orden->id") }}' class="my_form row"
                    enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @elseif($modo == 'create')
                    <form action="{{ url('ordenes/insert') }}" class="my_form row" enctype="multipart/form-data"
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
                            <label for="nombre">Descripción*</label> <input type="text" name="descripcion"
                                value="{{ $orden ? $orden->descripcion : '' }}" id="descripcion"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }} required>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="nombre">Equipo*</label> <input type="text" name="equipo"
                                value="{{ $orden ? $orden->equipo : '' }}" id="equipo"
                                class="form-control input-lg " {{ $mode == 'show' ? 'readonly' : '' }} required>
                        </div>
                        

                        <div class="form-group col-md-4">
                        </div>
                    </div>
                </div>
            </div>

            

        


            <div class="col-12">
                
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Vallas</h3>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="table-responsive">
                                <table id="tablacontratos" style="width:100%; border: 0;"
                                    class="table table-hover table-striped table-bordered table-sm display">
                                    <thead class="thead-tabla">
                                        <tr>
                                            @if($modo == "create")
                                                <th style="text-align: center; vertical-align: middle;" data-field="SelectALL"><input class="form-check-input mx-auto"
                                                    type="checkbox" value="" id="selectAll" /><label
                                                    class="form-check-label" for="flexCheckDefault">

                                                </label></th>
                                            @endif
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
                                                @if($modo == "create")
                                                <td style="text-align: center; vertical-align: middle;"><input class="form-check-input mx-auto" name="checked[]"
                                                        type="checkbox" value="{{ $valla->id }}"
                                                        id="flexCheckDefault" /><label class="form-check-label"
                                                        for="flexCheckDefault"></td>
                                                @endif
                                                <td style="text-align: center; vertical-align: middle;">{{ $valla->alias }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $valla->direccion }}</td>

                                                <td style="text-align: center; vertical-align: middle;"> 
                                                    <img id="pic{{ $index }}" style="width:130px; height=80px;"
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
                          
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Adjunto</h3>

                      
                    </div>
                    <div class="card-body row">

                            @if ($modo == 'create' || $modo == 'edit')
                                <div class="form-group col-4">
                                    <label for="adj">Archivo(PDF)</label> <input type="file" name="adj" 
                                        id="input" accept="*.pdf" class="form-control input-lg"
                                        {{ $modo == 'show' ? 'readonly' : '' }}>
                                </div>
                            @else
                   
                                @if(isset($orden->adjunto))
                                
                                    <embed 
                                        src="{{ url('public/storage')}}/{{$orden->adjunto}}"
                                        style="width: 70%; height: 30rem;  margin-left: auto;
                                        margin-right: auto;"
                                        frameborder="1"
                                    >
                               
                                @endif
                            @endif
                        

                        <div class="form-group col-md-4">
                        </div>
                    </div>
                </div>
            </div>
      

    <div class="col-12">

        <div class="card card-primary">
            <div class="card-footer">
                <a href="{{ url('ordenes') }}" class="btn btn-secondary float-left">Volver</a>
                @if ($modo != 'show')
                    <button type="button" id="guardar" name="mysubmit" data-toggle="modal" data-target="#modalmessage"
                        class="btn btn-primary float-right" disabled>Guardar</button>
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

 
   
</section>

</div></div>
</form>

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
        let guardar = document.getElementById('guardar')


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

        checks.forEach(check => {
            check.addEventListener('change', function() {
                if (check.checked == true) {
                    guardar.disabled = false;
                } else {
                    guardar.disabled = true;
                }
            });
        });




            $('#input').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#input').attr('value', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });




 


    </script>